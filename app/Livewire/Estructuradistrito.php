<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Distrito;
use App\Models\Distritosserv;
use App\Models\Grupo;
use App\Models\Util;
use Illuminate\Support\Facades\DB;

class Estructuradistrito extends Component
{
    use WithPagination;

	protected $paginationTheme = 'bootstrap';

    public $verModalGrupo=false, $verModalServidor = false, $verModalDistrito = false,
        $selected_id, $keyWord,
        $distritoObj, $servidores, $grupos,
		$tabActivo = 'tab1';
	public $servicios = [], $comites = [];
	public $datosDistrito = [], $datosGrupo = [], $datosServidor = [];

	protected $listeners = ['IdPadreElecto' => 'IdPadreElecto'];
	public function IdPadreElecto($tipo, $id)
	{
		$this->cargarInfoDis($id);
	}
    public function cargarInfoDis($id){
		$this->distritoObj = Distrito::with('Mcd')->find($id);
		$this->grupos = Grupo::where('IdDistrito', $id)
			->where('tipo', 'Grupo')
			->orderBy('localidad')
			->orderBy('grupo')
			->get();
		$this->servidores = Distritosserv::ordenado()
			->where('IdDistrito', $id)
			->with(['Comite', 'Servicio', 'ComiteCanalizado'])
			->get();      
    }
	public function render()
	{
		if(!$this->distritoObj) $this->IdPadreElecto ('xd',1);
		return view('livewire.estructura.distrito');
	}
	
    public function mount()
    {
        $this->servicios = DB::table('servicios')->orderBy('orden')->pluck('servicio','id');
        $this->comites = DB::table('comites')->orderBy('orden')->pluck('comite','id');
    }
    public function cancel()
    {
        $this->verModalGrupo = false;
        $this->verModalServidor = false;
        $this->verModalDistrito = false;
    }
    public function resetInput()
    {
        $this->resetExcept('servicios','comites', 'distritoObj','tabActivo');
        $this->cargarInfoDis($this->distritoObj->id);
    }
    public function editDistrito($id)
    {
        $this->selected_id = $id;
		$distrito = Distrito::findOrFail($id);
        $this->datosDistrito = $distrito->only($distrito->getFillable());
        $this->verModalDistrito = true;
    }

    public function saveDistrito()
    {
        $this->validate([
            'datosDistrito.direccion' => 'required|string|max:255',
            'datosDistrito.fechaHPle' => 'nullable|string|max:50',
            'datosDistrito.fechaHEst' => 'nullable|string|max:50',
            'datosDistrito.Gmaps' => 'nullable|string|max:255',
            'datosDistrito.ubicacion'   => 'nullable|string|max:100',
        ]);
        $this->datosDistrito['direccion'] = strtoupper ($this->datosDistrito['direccion']);
        $this->datosDistrito['fechaHPle'] = strtoupper ($this->datosDistrito['fechaHPle']);
        $this->datosDistrito['fechaHEst'] = strtoupper ($this->datosDistrito['fechaHEst']);
        foreach ($this->datosDistrito as $key => $value) {
            if ($value === '') {
                $this->datosDistrito[$key] = null;
            }
        }
        Distrito::updateOrCreate(
            ['id' => $this->selected_id],
            $this->datosDistrito
        );
        $this->verModalServidor = false;
        $this->resetInput();
    }    
    public function editGrupo($id)
    {
		$grupo = Grupo::findOrFail($id);
		$this->selected_id = $id;
		$this->datosGrupo = $grupo->only($grupo->getFillable());
        $this->verModalGrupo = true;
    }	
    public function createGrupo()
    {
        $this->resetInput();
        $this->verModalGrupo = true;
    }    
	
    public function saveGrupo()
    {
        $this->validate([
            'datosGrupo.grupo'      => 'required|string|max:100',
            'datosGrupo.IdDistrito' => 'required|integer',
            'datosGrupo.direccion' => 'required|string|max:150',
            'datosGrupo.localidad' => 'required|string|max:50',
            'datosGrupo.RSG' => 'nullable|string|max:50',
            'datosGrupo.telefonoRSG' => ['nullable','regex:/^[0-9,\s\-]{1,20}$/'],
            'datosGrupo.RSGSup' => 'nullable|string|max:50',
            'datosGrupo.miembros'   => 'required|integer',
            'datosGrupo.mujeres'    => 'nullable|integer',
            'datosGrupo.discapacitados' => 'nullable|integer',
            'datosGrupo.LGBTQyMas'  => 'nullable|integer',
        ]);
        $this->datosGrupo['telefonoRSG'] = preg_replace('/[^0-9,]/', '', $this->datosGrupo['telefonoRSG']);
        $this->datosGrupo['grupo'] = strtoupper ($this->datosGrupo['grupo']);
        $this->datosGrupo['direccion'] = strtoupper ($this->datosGrupo['direccion']);
        $this->datosGrupo['localidad'] = strtoupper ($this->datosGrupo['localidad']);
        $this->datosGrupo['RSG'] = strtoupper ($this->datosGrupo['RSG']);
        $this->datosGrupo['RSGSup'] = strtoupper ($this->datosGrupo['RSGSup']);
        foreach ($this->datosGrupo as $key => $value) {
            if ($value === '') {
                $this->datosGrupo[$key] = null;
            }
        }
        $g = Grupo::updateOrCreate(
            ['id' => $this->selected_id],
            $this->datosGrupo
        );
        $this->verModalGrupo = false;
        $this->resetInput();
    }

    public function editServidor($id)
    {
		$servidor = Distritosserv::findOrFail($id);
		$this->selected_id = $id;
		$this->datosServidor = $servidor->only($servidor->getFillable());
        $this->verModalServidor = true;
    }

    public function saveServidor()
    {
        $this->validate([
            'datosServidor.servidor'      => 'required|string|max:100',
            'datosServidor.IdServicio' => 'required|integer',
            'datosServidor.telefono' => ['nullable','regex:/^[0-9,\s\-]{1,20}$/'],
            'datosServidor.IdComite' => 'required|integer',
            'datosServidor.IdComiteCan'   => 'nullable|integer',
        ]);
        $this->datosServidor['servidor'] = strtoupper ($this->datosServidor['servidor']);
        $this->datosServidor['telefono'] = preg_replace('/[^0-9,]/', '', $this->datosServidor['telefono']);
        foreach ($this->datosServidor as $key => $value) {
            if ($value === '') {
                $this->datosServidor[$key] = null;
            }
        }
        Distritosserv::updateOrCreate(
            ['id' => $this->selected_id],
            $this->datosServidor
        );
        $this->verModalServidor = false;
        $this->resetInput();
    }

    public function destroyGrupo($id)
    {
        if ($id) {
            Grupo::where('id', $id)->delete();
            $this->resetInput();
        }
    }
    public function destroyServidor($id)
    {
        if ($id) {
            Distritosserv::where('id', $id)->delete();
            $this->resetInput();
        }
    }    
}