<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Grupo;
use Livewire\Attributes\Computed;
use App\Models\Util;
use Illuminate\Support\Facades\DB;

class Grupos extends Component
{
    use WithPagination;

	protected $paginationTheme = 'bootstrap';
    public $verModalGrupo=false, $selected_id, $keyWord, $IdDistrito, $grupo, $miembros, $mujeres, $discapacitados, $LGBTQyMas, $direccion, $localidad, $tipo, $RSG, $RSGSup, $telefonoRSG, $respCAsam, $foto, $gmaps, $ubicacion, $IdComite, $clase, $Obs, $asamblea1, $asamblea2, $vigente;
    
	public function updatedKeyWord()
	{
		$this->resetPage();
	}
    #[Computed]
	public function filteredGrupos()
	{
		$keyWord = '%' . $this->keyWord . '%';
		return Grupo::Where('tipo','Grupo')
			->where(function ($query) use ($keyWord) {
				$query
						->orWhere('grupo', 'LIKE', $keyWord)
						->orWhere('direccion', 'LIKE', $keyWord)
						->orWhere('localidad', 'LIKE', $keyWord)
						->orWhere('RSG', 'LIKE', $keyWord)
						->orWhere('RSGSup', 'LIKE', $keyWord)
						->orWhere('clase', 'LIKE', $keyWord)
						->orWhere('Obs', 'LIKE', $keyWord);
			})
			->orderBy('grupo')
			->paginate(12);
	}

	public function render()
	{
		return view('livewire.grupos.view', [
			'grupos' => $this->filteredGrupos,
		]);
	}
	
    public function cancel()
    {
        $this->verModalGrupo = false;
    }
    public function resetInput()
    {
        $this->reset();
    }
    public function edit($id)
    {
        $this->resetInput();
        $this->selected_id = $id;
		$this->fill(Grupo::findOrFail($id)->toArray());
        $this->verModalGrupo = true;
    }
    public function create()
    {
        $this->resetInput();
        $this->verModalGrupo = true;
    }    
    public function save()
    {
        $this->validate([
		'IdDistrito' => 'required',
		'grupo' => 'required',
		'vigente' => 'required',
        ]);

        Grupo::updateOrCreate(
			['id' => $this->selected_id],
			[
				'IdDistrito' => $this-> IdDistrito,
				'grupo' => $this-> grupo,
				'miembros' => $this-> miembros,
				'mujeres' => $this-> mujeres,
				'discapacitados' => $this-> discapacitados,
				'LGBTQyMas' => $this-> LGBTQyMas,
				'direccion' => $this-> direccion,
				'localidad' => $this-> localidad,
				'tipo' => $this-> tipo,
				'RSG' => $this-> RSG,
				'RSGSup' => $this-> RSGSup,
				'telefonoRSG' => $this-> telefonoRSG,
				'respCAsam' => $this-> respCAsam,
				'foto' => $this-> foto,
				'gmaps' => $this-> gmaps,
				'ubicacion' => $this-> ubicacion,
				'IdComite' => $this-> IdComite,
				'clase' => $this-> clase,
				'Obs' => $this-> Obs,
				'asamblea1' => $this-> asamblea1,
				'asamblea2' => $this-> asamblea2,
				'vigente' => $this-> vigente
			]
		);
        $this->verModalGrupo = false;
    }

    public function destroy($id)
    {
        if ($id) {
            Grupo::where('id', $id)->delete();
        }
    }
}