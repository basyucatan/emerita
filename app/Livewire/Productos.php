<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Producto;
use Livewire\Attributes\Computed;
use App\Models\Util;
use Illuminate\Support\Facades\DB;

class Productos extends Component
{
    use WithPagination;

	protected $paginationTheme = 'bootstrap';
    public $verModalProducto=false, $selected_id, $keyWord, $codigo, $foto, $linkCMSG, $producto, $IdClase, $precioU, $precioN, $costoU, $stockMin, $pDescuento, $activo, $obs;
	
    public function updatedKeyWord()
	{
		$this->resetPage();
	}
    #[Computed]
	public function filteredProductos()
	{
		$keyWord = '%' . $this->keyWord . '%';
		return Producto::Where('id','>',0)
			->where(function ($query) use ($keyWord) {
				$query
						->orWhere('codigo', 'LIKE', $keyWord)
						->orWhere('foto', 'LIKE', $keyWord)
						->orWhere('linkCMSG', 'LIKE', $keyWord)
						->orWhere('producto', 'LIKE', $keyWord)
						->orWhere('IdClase', 'LIKE', $keyWord)
						->orWhere('precioU', 'LIKE', $keyWord)
						->orWhere('precioN', 'LIKE', $keyWord)
						->orWhere('costoU', 'LIKE', $keyWord)
						->orWhere('stockMin', 'LIKE', $keyWord)
						->orWhere('pDescuento', 'LIKE', $keyWord)
						->orWhere('activo', 'LIKE', $keyWord)
						->orWhere('obs', 'LIKE', $keyWord);
			})
			->paginate(12);
	}

	public function render()
	{
		return view('livewire.productos.view', [
			'productos' => $this->filteredProductos,
		]);
	}
	
    public function cancel()
    {
        $this->resetInput();
        $this->verModalProducto = false;
    }

    public function resetInput()
    {
        $this->reset();
    }

    public function edit($id)
    {
        $this->selected_id = $id;
		$this->fill(Producto::findOrFail($id)->toArray());
        $this->verModalProducto = true;
    }
    public function create()
    {
        $this->resetInput();
        $this->verModalProducto = true;
    }    
    public function save()
    {
        $this->validate([
		'codigo' => 'required',
		'producto' => 'required',
		'IdClase' => 'required',
		'precioU' => 'required',
		'precioN' => 'required',
		'costoU' => 'required',
		'stockMin' => 'required',
		'pDescuento' => 'required',
		'activo' => 'required',
		'obs' => 'required',
        ]);

        Producto::updateOrCreate(
			['id' => $this->selected_id],
			[
				'codigo' => $this-> codigo,
				'foto' => $this-> foto,
				'linkCMSG' => $this-> linkCMSG,
				'producto' => $this-> producto,
				'IdClase' => $this-> IdClase,
				'precioU' => $this-> precioU,
				'precioN' => $this-> precioN,
				'costoU' => $this-> costoU,
				'stockMin' => $this-> stockMin,
				'pDescuento' => $this-> pDescuento,
				'activo' => $this-> activo,
				'obs' => $this-> obs
			]
		);
        $this->resetInput();
        $this->verModalProducto = false;
    }

    public function destroy($id)
    {
        if ($id) {
            Producto::where('id', $id)->delete();
        }
    }
}