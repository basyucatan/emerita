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

class Carritos extends Component
{
	use WithPagination;
	
	public $deptoSel = null, $keyWord, $IdClase=null, $verModalDatos = false,
		$Pedido, $IdDistrito, $telefono, $nombre;
	public $deptos = [], $clases = [], $distritos = [],
		$Productos = [], $cantidades = [], $cantidadesPedido = [];
	public function mount(){
		$this->distritos = DB::table('distritos')->orderBy('orden')->pluck('distrito','id');
		$this->clases = Util::getArray('clases');
		$this->deptos = DB::table('clases')->select('depto')->distinct()->pluck('depto','depto');
		$this->buscarProductos();
		$this->Pedido = Pedido::with(['Pedidosdets.Producto'])->find(161);
	}
	public function updatedKeyWord() { $this->buscarProductos(); }

	public function elegirDepto()
	{
	    $this->IdClase = null;
		$this->clases = DB::table('clases')
		->where('depto', $this->deptoSel)
		->orderby('orden')
		->pluck('clase','id');
		$this->dispatch('actualizarLista', arrayActual: $this->clases, campo: 'IdClase');  
	}
	public function render()
	{
		return view('livewire.carritos.view');
	}

public function buscarProductos()
{
    $keyWord = trim($this->keyWord);
    $this->Productos = Producto::query()
        ->join('clases', 'clases.id', '=', 'productos.IdClase')
        ->when($this->IdClase, fn ($q) =>
            $q->where('productos.IdClase', $this->IdClase)
        )
        ->when($this->deptoSel, fn ($q) =>
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
        ->orderBy('productos.producto')
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
    public function cancel(){
		$this->resetInput();
	}
    public function resetInput(){
		$this->resetExcept('Pedido', 'deptos', 'clases', 'distritos', 
			'Productos', 'cantidades');
	}
    public function guardar(){
		if ( empty($this->cantidades)){
            $mensaje = ['📢 Agrega produtos al pedido!', 1500, 'warning'];
            $this->dispatch('sweetalert', SweetAlert::mensaje($mensaje));
			return;
		}
		if (!$this->Pedido){
			$this->verModalDatos = true;
		} else {
			$this->savePedido($this->Pedido->id);
		}
	}

	public function cargarDetalles()
	{
		if(!$this->Pedido) return;
		$this->cantidadesPedido = DB::table('pedidosdets')
			->where('IdPedido', $this->Pedido->id)
			->pluck('cantidad', 'id')
			->toArray();
	}

    public function savePedido($id = null)
    {
		$this->verModalDatos = false;
		if ( empty($this->cantidades)){
            $mensaje = ['📢 Agrega produtos al pedido!', 1500, 'warning'];
            $this->dispatch('sweetalert', SweetAlert::mensaje($mensaje));
			return;
		}
        if (empty($this->Pedido?->id)) {
			$IdUser = auth()->user()->id ?? 2;
			$user = User::find($IdUser);
			$adicionales = ['IdDistrito' => $this->IdDistrito,
				'telefono' => $this->telefono, 'nombre' => $this->nombre,];
            $this->Pedido = Pedido::create([
                'IdUser' => $user->id,
                'IdCliente' => $user->id,
                'FechaH'  => now()->tz('America/Mexico_City'),
                'estatus' => 'CARRITO',
                'adicionales' => $adicionales,
            ]);
            $mensaje = ['✅ Se creó un nuevo pedido!', 1500, 'success'];
            $this->dispatch('sweetalert', SweetAlert::mensaje($mensaje));
        }
        $existe = PedidosDet::where('IdPedido', $this->Pedido->id)
            ->first();
        if ($existe) {
            PedidosDet::where('IdPedido', $this->Pedido->id)->delete();
        }
		foreach ($this->cantidades as $IdProducto => $cantidad) {
			if ($cantidad <= 0) {
				continue;
			}
			$producto = Producto::find($IdProducto);
			PedidosDet::create([
				'IdPedido'   => $this->Pedido->id,
				'IdProducto' => $IdProducto,
				'cantidad'   => $cantidad,
				'precioU'    => $producto?->precioU ?? 0,
				'adicionales'=> null,
			]);
		}
		$this->cargarDetalles();
        $mensaje = ['👍 Pedido Guardado!', 1000, 'success'];
        $this->dispatch('sweetalert',SweetAlert::mensaje($mensaje));
        $this->buscarProductos();
        $this->dispatch('IdPedidoEnHijo', $this->Pedido->id);
    }

public function saveDets()
{
    if (!$this->Pedido?->id) {
        return;
    }
    foreach ($this->cantidadesPedido as $IdDet => $cantidad) {
        PedidosDet::where('id', $IdDet)
            ->where('IdPedido', $this->Pedido->id)
            ->update([
                'cantidad' => (int)$cantidad,
            ]);
    }
    $this->dispatch('sweetalert',
        SweetAlert::mensaje(['💾 Detalles guardados', 1000, 'success'])
    );
}

}