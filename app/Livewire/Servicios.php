<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Servicio;
use Livewire\Attributes\Computed;
use App\Models\Util;
use Illuminate\Support\Facades\DB;

class Servicios extends Component
{
    use WithPagination;

	protected $paginationTheme = 'bootstrap';
    public $verModalServicio=false, $selected_id, $keyWord, $servicio, $abreviatura, $orden;

    #[Computed]
	public function filteredServicios()
	{
		$keyWord = '%' . $this->keyWord . '%';
		return Servicio::Where('id','>',0)
			->where(function ($query) use ($keyWord) {
				$query
						->orWhere('servicio', 'LIKE', $keyWord)
						->orWhere('abreviatura', 'LIKE', $keyWord)
						->orWhere('orden', 'LIKE', $keyWord);
			})
			->paginate(10);
	}

	public function render()
	{
		return view('livewire.servicios.view', [
			'servicios' => $this->filteredServicios,
		]);
	}
	
    public function cancel()
    {
        $this->verModalServicio = false;
    }
    public function resetInput()
    {
        $this->reset();
    }
    public function edit($id)
    {
        $this->resetInput();
        $this->selected_id = $id;
		$this->fill(Servicio::findOrFail($id)->toArray());
        $this->verModalServicio = true;
    }
    public function create()
    {
        $this->resetInput();
        $this->verModalServicio = true;
    }    
    public function save()
    {
        $this->validate([
		'servicio' => 'required',
		'abreviatura' => 'required',
		'orden' => 'required',
        ]);

        Servicio::updateOrCreate(
			['id' => $this->selected_id],
			[
				'servicio' => $this-> servicio,
				'abreviatura' => $this-> abreviatura,
				'orden' => $this-> orden
			]
		);
        $this->verModalServicio = false;
    }

    public function destroy($id)
    {
        if ($id) {
            Servicio::where('id', $id)->delete();
        }
    }
}