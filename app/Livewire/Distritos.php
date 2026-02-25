<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Distrito;
use Livewire\Attributes\Computed;
use App\Models\Util;
use Illuminate\Support\Facades\DB;

class Distritos extends Component
{
    use WithPagination;

	protected $paginationTheme = 'bootstrap';
    public $verModalDistrito=false, $selected_id, $keyWord, $distrito, $panel, $orden, $direccion, $telefono, $foto, $gmaps, $ubicacion, $fechaHPle, $fechaHEst, $fechaHSer, $fechaHEva, $obs, $adicionales, $porcionGeo;

    #[Computed]
	public function filteredDistritos()
	{
		$keyWord = '%' . $this->keyWord . '%';
		return Distrito::Where('id','>',0)
			->where(function ($query) use ($keyWord) {
				$query
						->orWhere('distrito', 'LIKE', $keyWord)
						->orWhere('panel', 'LIKE', $keyWord)
						->orWhere('direccion', 'LIKE', $keyWord)
						->orWhere('obs', 'LIKE', $keyWord);
			})
			->orderby('orden')
			->paginate(12);
	}

	public function render()
	{
		return view('livewire.distritos.view', [
			'distritos' => $this->filteredDistritos,
		]);
	}
	
    public function cancel()
    {
        $this->verModalDistrito = false;
    }
    public function resetInput()
    {
        $this->reset();
    }
    public function edit($id)
    {
        $this->resetInput();
        $this->selected_id = $id;
		$this->fill(Distrito::findOrFail($id)->toArray());
        $this->verModalDistrito = true;
    }
    public function create()
    {
        $this->resetInput();
        $this->verModalDistrito = true;
    }    
    public function save()
    {
        $this->validate([
		'distrito' => 'required',
		'orden' => 'required',
		'direccion' => 'required',
        ]);

        Distrito::updateOrCreate(
			['id' => $this->selected_id],
			[
				'distrito' => $this-> distrito,
				'panel' => $this-> panel,
				'orden' => $this-> orden,
				'direccion' => $this-> direccion,
				'telefono' => $this-> telefono,
				'foto' => $this-> foto,
				'gmaps' => $this-> gmaps,
				'ubicacion' => $this-> ubicacion,
				'fechaHPle' => $this-> fechaHPle,
				'fechaHEst' => $this-> fechaHEst,
				'fechaHSer' => $this-> fechaHSer,
				'fechaHEva' => $this-> fechaHEva,
				'obs' => $this-> obs,
				'adicionales' => $this-> adicionales,
				'porcionGeo' => $this-> porcionGeo
			]
		);
        $this->verModalDistrito = false;
    }

    public function destroy($id)
    {
        if ($id) {
            Distrito::where('id', $id)->delete();
        }
    }
}