<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Util;
use App\Models\User;
use App\Models\Producto;
use App\Models\Pedido;
use App\Models\Pedidosdet;
use Illuminate\Support\Facades\DB;
use App\Helpers\SweetAlert;
use Barryvdh\DomPDF\Facade\Pdf;

class Carritos extends Component
{
	use WithPagination;

	public $deptoSel = null, $keyWord, $IdClase = null, $verModalDatos = false,
		$Pedido, $IdDistrito, $telefono, $nombre;
	public $deptos = [], $clases = [], $distritos = [],
		$Productos = [], $cantsProds = [], $cantsDets = [], $pedsPends = [];
	public function mount()
	{
		$this->distritos = DB::table('distritos')->orderBy('orden')->pluck('distrito', 'id');
		$this->clases = Util::getArray('clases');
		$this->deptos = DB::table('clases')->select('depto')->distinct()->pluck('depto', 'depto');
		$this->buscarProductos();
		$this->getPedidos();
	}
	private function getPedidos()
	{
		$this->pedsPends = Pedido::whereIn('estatus', ['CARRITO', 'CONFIRMADO'])
			->orderBy('FechaH', 'desc')->get();
	}
	public function updatedKeyWord()
	{
		$this->buscarProductos();
	}
	public function elegirPedido($id)
	{
		$this->Pedido = Pedido::find($id);
		$this->cargarArrayProds();
		$this->cargarArrayDets();
	}
	public function elegirDepto()
	{
		$this->IdClase = null;
		$this->clases = DB::table('clases')
			->where('depto', $this->deptoSel)
			->orderby('orden')
			->pluck('clase', 'id');
		$this->dispatch('actualizarLista', arrayActual: $this->clases, campo: 'IdClase');
	}
	public function render()
	{
		return view('livewire.carritos.view');
	}

	public function aplicarFiltros($aplicar = true)
	{
		if (!$aplicar) {
			$this->IdClase = null;
			$this->deptoSel = null;
		} else {
			$this->buscarProductos();
		}
	}

	public function buscarProductos()
	{
		$keyWord = trim($this->keyWord);
		$this->Productos = Producto::query()
			->join('clases', 'clases.id', '=', 'productos.IdClase')
			->when(
				$this->IdClase,
				fn($q) =>
				$q->where('productos.IdClase', $this->IdClase)
			)
			->when(
				$this->deptoSel,
				fn($q) =>
				$q->where('clases.depto', $this->deptoSel)
			)
			->when($keyWord !== '', function ($q) use ($keyWord) {
				$kw = "%{$keyWord}%";

				$q->where(function ($sub) use ($kw) {
					$sub->where('productos.producto', 'LIKE', $kw)
						->orWhere('productos.codigo', 'LIKE', $kw);
				});
			})
			->orderBy('clases.orden')
			->orderBy('productos.codigo')
			->select('productos.*')
			->get();
	}

	public function quitarFiltro(string $filtro)
	{
		match ($filtro) {
			'Clase' => $this->IdClase = null,
			'Depto' => $this->deptoSel = null,
			default => null,
		};
		$this->buscarProductos();
	}
	public function cancel()
	{
		$this->resetInput();
	}
	public function resetInput()
	{
		$this->resetExcept(
			'Pedido',
			'deptos',
			'clases',
			'distritos',
			'Productos',
			'pedsPends',
		);
	}

	public function nuevoPedido()
	{
		$this->Pedido = null;
		$this->verModalDatos = true;
		$this->getPedidos();
	}

	public function savePedido()
	{
		$this->verModalDatos = false;
		$IdUser = auth()->user()->id ?? 2;
		$user = User::find($IdUser);
		$adicionales = [
			'IdDistrito' => $this->IdDistrito,
			'telefono' => $this->telefono,
			'nombre' => $this->nombre,
		];
		$this->Pedido = Pedido::create([
			'IdUser' => $user->id,
			'IdCliente' => $user->id,
			'FechaH'  => now()->tz('America/Mexico_City'),
			'estatus' => 'CARRITO',
			'adicionales' => $adicionales,
		]);
		$this->saveProds();
		$this->getPedidos();
		$mensaje = ['✅ Se creó un nuevo pedido!', 1500, 'success'];
		$this->dispatch('sweetalert', SweetAlert::mensaje($mensaje));
	}
	public function saveProds()
	{
		if (!$this->cantsProds) return;
		if (!$this->Pedido) {
			$this->verModalDatos = true;
			return;
		}
		PedidosDet::where('IdPedido', $this->Pedido->id)->delete();
		foreach ($this->cantsProds as $IdProducto => $cantidad) {
			if ($cantidad <= 0) {
				continue;
			}
			$producto = Producto::find($IdProducto);
			PedidosDet::create([
				'IdPedido'   => $this->Pedido->id,
				'IdProducto' => $IdProducto,
				'cantidad'   => $cantidad,
				'precioU'    => $producto?->precioU ?? 0,
				'adicionales' => null,
			]);
		}
		$this->cargarArrayProds();
		$this->cargarArrayDets();
		$this->dispatch(
			'sweetalert',
			SweetAlert::mensaje(['💾 Pedido Guardado !', 1000, 'success'])
		);
	}

	public function cargarArrayProds()
	{
		if (!$this->Pedido) return;
		$this->cantsProds = [];
		foreach ($this->Pedido->Pedidosdets as $det) {
			$this->cantsProds[$det->IdProducto] = $det->cantidad;
		}
		$this->cantsProds = array_filter(
			$this->cantsProds,
			fn($cantidad) => $cantidad > 0
		);
	}
	public function cargarArrayDets()
	{
		if (!$this->Pedido) return;
		$this->cantsDets = [];
		PedidosDet::where('cantidad', 0)->delete();
		$this->cantsDets = DB::table('pedidosdets')
			->where('IdPedido', $this->Pedido->id)
			->pluck('cantidad', 'id')
			->toArray();
	}

	public function saveDets()
	{
		if (!$this->Pedido) return;
		foreach ($this->cantsDets as $IdDet => $cantidad) {
			PedidosDet::where('id', $IdDet)
				->where('IdPedido', $this->Pedido->id)
				->update([
					'cantidad' => (int)$cantidad,
				]);
		}
		$this->cargarArrayDets();
		$this->cargarArrayProds();
		$this->dispatch(
			'sweetalert',
			SweetAlert::mensaje(['💾 Pedido Guardado !', 1000, 'success'])
		);
	}

	public function borrarPedido($id)
	{
		Pedido::find($id)->delete();
		$this->Pedido = null;
		$this->getPedidos();
		$this->cantsProds = [];
		$this->cantsDets = [];
		$this->dispatch(
			'sweetalert',
			SweetAlert::mensaje(['❌ Pedido Eliminado', 1000, 'success'])
		);
	}

	public function confirmar()
	{
		$this->Pedido->estatus = 'CONFIRMADO';
		$this->Pedido->update();
	}
  
    public function imprimir($depto = null) {
		$pedido = Pedido::where('id', $this->Pedido->id)
			->with(['PedidosDets.Producto.Clase'])
			->firstOrFail();

		$dets = $pedido->PedidosDets;
		if ($depto) {
			$dets = $dets->filter(function ($det) use ($depto) {
				return ($det->Producto->Clase->depto ?? null) === $depto;
			});
		}
		$groupedDets = $dets->groupBy(
			fn ($det) => $det->Producto->Clase->depto ?? 'Sin Departamento'
		);
		$totalFilas = $dets->count();
        $deptTotals = $groupedDets->map(function ($items) {
            return [
                'totalArticulos' => $items->sum('cantidad'),
                'totalImporte' => $items->sum(fn($item) => $item->cantidad * $item->precioU),
            ];
        });
		if ($totalFilas > 25) {
			$view  = 'livewire.carritos.pedidoPDFLargo';
			$paper = ['letter', 'portrait'];
		} else {
			$view  = 'livewire.carritos.pedidoPDF';
			$paper = ['letter', 'landscape'];
		}
		$pdf = Pdf::loadView($view, compact(
			'pedido',
			'groupedDets',
			'deptTotals'
		))->setPaper(...$paper);
        $folder = public_path('pedidos');
        if (!file_exists($folder)) mkdir($folder, 0775, true);
        $pdfName = 'pedido.pdf';
        $pdfPath = $folder .'/'.$pdfName;
        $pdfPath = public_path("pedidos/$pdfName");
        $pdf->save($pdfPath);
        return response()->file($pdfPath, [
            'Content-Type' => 'application/pdf',
            'Content-Disposition' => 'inline; filename="'.$pdfName.'"'
        ]);
    }
}

