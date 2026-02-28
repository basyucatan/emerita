<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Modelosmat;
use Livewire\Attributes\Computed;
use App\Models\Util;
use Illuminate\Support\Facades\DB;

class Modelosmats extends Component
{
    use WithPagination;

	protected $paginationTheme = 'bootstrap';
    public $verModalModelosmat=false, $selected_id, $keyWord, $IdModelo, $principal,
		$cantidad, $IdMaterial, $IdTablaHerraje, $cantidadHerraje, $diferenciador, $IdTipo, 
		$posicion, $formula, $errFormula, $dimensiones, $costo, $tipCosto, $adicionales, $obs;

	public $tipos=[];
    #[Computed]
	public function filteredModelosmats()
	{
		// $keyWord = '%' . $this->keyWord . '%';
		// return Modelosmat::Where('IdModelo', $this->IdModelo)
		// 	->get();

		$keyWord = '%' . $this->keyWord . '%';
		return Modelosmat::query()
			->select('modelosmats.*')
			->join('materials', 'materials.id', '=', 'modelosmats.IdMaterial')
			->join('clases', 'clases.id', '=', 'materials.IdClase')
			->leftJoin('tipos', 'tipos.id', '=', 'materials.IdTipo')
			->where('IdModelo', $this->IdModelo)
			->where(function ($query) use ($keyWord) {
				$query->where('materials.material', 'LIKE', "%{$keyWord}%")
					->orWhere('materials.referencia', 'LIKE', "%{$keyWord}%");
			})
			->with(['material.clase', 'material.tipo'])
			->orderBy('clases.orden')
			->orderBy('tipos.orden')
			->orderByDesc('modelosmats.principal')
			->orderBy('materials.id')
			->orderBy('modelosmats.posicion')
			->get();		
		
	}

	public function mount()
	{
		$this->tipos = Util::getArray('tipos');
	}
	public function render()
	{
		return view('livewire.modelosmats.view', [
			'modelosmats' => $this->filteredModelosmats,
		]);
	}
	
    public function cancel()
    {
        $this->resetInput();
        $this->verModalModelosmat = false;
    }
    public function resetInput()
    {
    }
    public function edit($id)
    {
        $this->selected_id = $id;
		$this->fill(Modelosmat::findOrFail($id)->toArray());
        $this->verModalModelosmat = true;
    }
    public function create()
    {
        $this->resetInput();
        $this->verModalModelosmat = true;
    }    
    public function save()
    {
        $this->validate([
		'IdModelo' => 'required',
		'principal' => 'required',
		'cantidad' => 'required',
        ]);

        Modelosmat::updateOrCreate(
			['id' => $this->selected_id],
			[
				'IdModelo' => $this-> IdModelo,
				'principal' => $this-> principal,
				'cantidad' => $this-> cantidad,
				'IdMaterial' => $this-> IdMaterial,
				'IdTablaHerraje' => $this-> IdTablaHerraje,
				'cantidadHerraje' => $this-> cantidadHerraje,
				'diferenciador' => $this-> diferenciador,
				'IdTipo' => $this-> IdTipo,
				'posicion' => $this-> posicion,
				'formula' => $this-> formula,
				'errFormula' => $this-> errFormula,
				'dimensiones' => $this-> dimensiones,
				'costo' => $this-> costo,
				'tipCosto' => $this-> tipCosto,
				'adicionales' => $this-> adicionales,
				'obs' => $this-> obs
			]
		);
        $this->resetInput();
        $this->verModalModelosmat = false;
    }

    public function destroy($id)
    {
        if ($id) {
            Modelosmat::where('id', $id)->delete();
        }
    }
}