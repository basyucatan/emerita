<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Traspaso;
use Livewire\Attributes\Computed;
use App\Models\Util;
use Illuminate\Support\Facades\DB;

class Traspasos extends Component
{
    use WithPagination;

	protected $paginationTheme = 'bootstrap';
    public $verModalTraspaso=false, $selected_id, $keyWord, $tipo, $IdUserEnv, $IdUserRec, $IdDeptoOri, $IdDeptoDes, $fecha, $estatus, $adicionales;

    #[Computed]
	public function filteredTraspasos()
	{
		$keyWord = '%' . $this->keyWord . '%';
		return Traspaso::Where('id','>',0)
			->where(function ($query) use ($keyWord) {
				$query
						->orWhere('tipo', 'LIKE', $keyWord)
						->orWhere('IdUserEnv', 'LIKE', $keyWord)
						->orWhere('IdUserRec', 'LIKE', $keyWord)
						->orWhere('IdDeptoOri', 'LIKE', $keyWord)
						->orWhere('IdDeptoDes', 'LIKE', $keyWord)
						->orWhere('fecha', 'LIKE', $keyWord)
						->orWhere('estatus', 'LIKE', $keyWord)
						->orWhere('adicionales', 'LIKE', $keyWord);
			})
			->paginate(10);
	}

	public function render()
	{
		return view('livewire.traspasos.view', [
			'traspasos' => $this->filteredTraspasos,
		]);
	}
	
    public function cancel()
    {
        $this->reset();
        $this->verModalTraspaso = false;
    }

    public function edit($id)
    {
        $this->selected_id = $id;
		$this->fill(Traspaso::findOrFail($id)->toArray());
        $this->verModalTraspaso = true;
    }
    public function create()
    {
        $this->reset();
        $this->verModalTraspaso = true;
    }    
    public function save()
    {
        $this->validate([
		'tipo' => 'required',
		'fecha' => 'required',
		'estatus' => 'required',
        ]);

        Traspaso::updateOrCreate(
			['id' => $this->selected_id],
			[
				'tipo' => $this-> tipo,
				'IdUserEnv' => $this-> IdUserEnv,
				'IdUserRec' => $this-> IdUserRec,
				'IdDeptoOri' => $this-> IdDeptoOri,
				'IdDeptoDes' => $this-> IdDeptoDes,
				'fecha' => $this-> fecha,
				'estatus' => $this-> estatus,
				'adicionales' => $this-> adicionales
			]
		);
        $this->reset();
        $this->verModalTraspaso = false;
    }

    public function destroy($id)
    {
        if ($id) {
            Traspaso::where('id', $id)->delete();
        }
    }
}