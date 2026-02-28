<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Modelo;
use Livewire\Attributes\Computed;
use App\Models\Util;
use Illuminate\Support\Facades\DB;
use Livewire\WithFileUploads;

class Modelos extends Component
{
    use WithPagination, WithFileUploads;

	protected $paginationTheme = 'bootstrap';
    public $verModalModelo=false, $selected_id, $selected_id2, $keyWord, 
		$IdMarca, $IdLinea, $modelo, $foto, $fichaTecnica, $fichaSubida, 
		$estatus, $svg;
	public $marcas =[], $lineas=[], $estados=[];
	
	public function updatingKeyWord()
	{
		$this->resetPage();
	}	
	#[Computed]
	public function filteredModelos()
	{
		$keyWord = '%' . $this->keyWord . '%';
		return Modelo::query()
			->select('modelos.*')
			->join('lineas', 'lineas.id', '=', 'modelos.IdLinea')
			->join('marcas', 'marcas.id', '=', 'lineas.IdMarca')
			->where(function ($query) use ($keyWord) {
				$query->orWhere('modelos.modelo', 'LIKE', $keyWord)
					->orWhere('modelos.estatus', 'LIKE', $keyWord)
					->orWhere('lineas.linea', 'LIKE', $keyWord)
					->orWhere('marcas.marca', 'LIKE', $keyWord);
			})
			->orderBy('marcas.marca')
			->orderBy('lineas.linea')
			->orderBy('modelos.modelo')
			->paginate(8);
	}

	public function mount()
	{
		$this->marcas = Util::getArray('marcas');
		$this->estados = Util::getArray('modelos','estatus');
		$this->getLineas();
	}
	public function getLineas($IdMarca = null)
	{
		$this->lineas = DB::table('lineas')
			->join('marcas', 'lineas.IdMarca', '=', 'marcas.id')
			->when($IdMarca, function ($query, $IdMarca) {
				return $query->where('lineas.IdMarca', $IdMarca);
			})
			->selectRaw("lineas.id, CONCAT(marcas.marca, ' | ', lineas.linea) as nombreCombinado")
			->orderBy('marcas.marca', 'asc')
			->orderBy('lineas.linea', 'asc')
			->pluck('nombreCombinado', 'id');
	}
	public function render()
	{
		return view('livewire.modelos.view', [
			'modelos' => $this->filteredModelos,
		]);
	}
    public function elegir($id)
    {
        $this->selected_id2 = $id;
    }
    public function elegirMarca()
    {
		$this->lineas = DB::table('lineas')->where('IdMarca', $this->IdMarca)
			->pluck('linea', 'id');			
    }	
    public function cancel()
    {
        $this->resetInput();
        $this->verModalModelo = false;
    }
    public function edit($id)
    {
        $this->selected_id = $id;
        $this->selected_id2 = $id;
		$modelo = Modelo::findOrFail($id);
		$this->fill($modelo->toArray());
		$this->IdMarca = $modelo->Linea->Marca->id;
		$this->getLineas($this->IdMarca);
        $this->verModalModelo = true;
    }
    public function create()
    {
        $this->resetInput();
        $this->verModalModelo = true;
    }  
    public function resetInput()
    {
		$this->resetExcept('selected_id2', 'marcas', 'lineas', 'estados','keyWord');
    } 	

    public function save()
    {
        $this->validate([
		'IdLinea' => 'required',
		'modelo' => 'required',
		'estatus' => 'required',
        ]);
		$archivoFicha = $this->fichaTecnica;
		$linea = \App\Models\Linea::find($this->IdLinea);
		$marca= $linea->marca->marca ?? 'generico';
		$rutaMarca = strtolower(mb_convert_encoding($marca, 'UTF-8', 'UTF-8'));	
		if ($this->fichaSubida && $this->selected_id) {
			$modelo = Modelo::find($this->selected_id);
			Util::borrarArchivo($this->selected_id, Modelo::class, $modelo->rutaFicha, 'fichaTecnica');
			$archivoFicha = Util::guardarArchivo($this->fichaSubida, $this->modelo, "modelos/" . $rutaMarca);
		}		
        Modelo::updateOrCreate(
			['id' => $this->selected_id],
			[
				'IdLinea' => $this-> IdLinea,
				'modelo' => $this-> modelo,
				'foto' => $this-> foto,
				'fichaTecnica' => $this-> fichaTecnica,
				'fichaTecnica' => $archivoFicha,
				'estatus' => $this-> estatus,
				'svg' => $this-> svg
			]
		);
        $this->resetInput();
        $this->verModalModelo = false;
    }

    public function destroy($id)
    {
        if ($id) {
            Modelo::where('id', $id)->delete();
        }
    }
}