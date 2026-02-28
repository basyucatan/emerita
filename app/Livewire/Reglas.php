<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Regla;
use Livewire\Attributes\Computed;
use App\Models\Util;
use Illuminate\Support\Facades\DB;

class Reglas extends Component
{
    use WithPagination;

	protected $paginationTheme = 'bootstrap';
    public $verModalRegla=false, $selected_id, $keyWord, $IdLinea, $IdMaterial, $IdTipo, 
		$IdMatRelacion, $descuento, $baseCalculo, $efectoCalculo, $factor, $IdVidrio;
	public $lineas = [], $materials = [], $bases = [], $tipos = [], $grosors = [];
	protected $listeners = [
		'cargarMaterialRelacion' => 'cargarMaterialRelacion',
	];
	#[Computed]
    public function filteredReglas()
    {
        $keyWord = '%' . $this->keyWord . '%';

        return Regla::where('IdMaterial', $this->IdMaterial)
            ->where(function ($query) use ($keyWord) {
                $query->orWhereHas('materialRel', function ($q) use ($keyWord) {
                        $q->where('material', 'LIKE', $keyWord);
                    })
                    ->orWhereHas('linea', function ($q) use ($keyWord) {
                        $q->where('linea', 'LIKE', $keyWord);
                    })
                    ->orWhere('baseCalculo', 'LIKE', $keyWord)
                    ->orWhere('efectoCalculo', 'LIKE', $keyWord)
                    ->orWhere('factor', 'LIKE', $keyWord);
            })
            ->orderBy('IdMatRelacion', 'asc')
            ->paginate(10);
    }	
	public function mount(){
		$this->tipos = Util::getArray('tipos');
		$this->lineas = Util::getArray('lineas');      
        $this->lineas = DB::table('lineas')
            ->join('marcas', 'lineas.IdMarca', '=', 'marcas.id')
            ->whereExists(function ($query) {
                $query->select(DB::raw(1))
                    ->from('modelos')
                    ->whereColumn('modelos.IdLinea', 'lineas.id');
            })
            ->select(
                'lineas.id',
                DB::raw("CONCAT(marcas.marca, ' | ', lineas.linea) as nombreCombinado")
            )
            ->orderBy('marcas.marca', 'asc')
            ->orderBy('lineas.linea', 'asc')
            ->pluck('nombreCombinado', 'id');

		$this->materials = Util::getArray('materials');
		$this->bases = Util::getArray('reglas','baseCalculo');
		$this->grosors = Util::getArray('vidrios','grosor');
	}
	public function render()
	{
		return view('livewire.reglas.view', [
			'reglas' => $this->filteredReglas,
		]);
	}

    public function resetInput()
    {
		$this->reset('selected_id','IdLinea',
			'baseCalculo','efectoCalculo','factor');
	}		
    public function cancel()
    {
        $this->resetInput();
        $this->verModalRegla = false;
    }

    public function edit($id)
    {
        $this->selected_id = $id;
		$this->fill(Regla::findOrFail($id)->toArray());
        $this->verModalRegla = true;
    }
	public function cargarMaterialRelacion($id){
		$material = \App\Models\Material::find($id);
		$this->IdMatRelacion = $id;	
		$this->create();
	}
    public function create()
    {
        $this->resetInput();
        $this->verModalRegla = true;
    }    
    public function save()
    {
        $this->validate([
		'IdMaterial' => 'required',
		'IdMatRelacion' => 'required',
		'baseCalculo' => 'required',
		'efectoCalculo' => 'required',
		'factor' => 'required',
        ]);

        Regla::updateOrCreate(
			['id' => $this->selected_id],
			[
				'IdLinea' => $this-> IdLinea,
				'IdMaterial' => $this-> IdMaterial,
				'IdTipo' => $this-> IdTipo ?: null,
				'IdVidrio' => $this->IdVidrio ?: null,
				'IdMatRelacion' => $this-> IdMatRelacion,
				'baseCalculo' => $this-> baseCalculo,
				'efectoCalculo' => $this-> efectoCalculo,
				'descuento' => $this->descuento ?: null,
				'factor' => $this-> factor
			]
		);
        $this->resetInput();
        $this->verModalRegla = false;
    }
    public function destroy($id)
    {
        if ($id) {
            Regla::where('id', $id)->delete();
        }
    }
}