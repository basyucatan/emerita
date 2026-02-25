<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Distritosserv;
use Livewire\Attributes\Computed;
use App\Models\Util;
use Illuminate\Support\Facades\DB;

class Distritosservs extends Component
{
    use WithPagination;

	protected $paginationTheme = 'bootstrap';
    public $verModalDistritosserv=false, $selected_id, $keyWord, $IdDistrito, $IdServicio, $IdComite, $IdComiteCan, $servidor, $telefono, $asamblea1, $asamblea2;

    #[Computed]
	public function filteredDistritosservs()
	{
		$keyWord = '%' . $this->keyWord . '%';
		return Distritosserv::Where('id','>',0)
			->where(function ($query) use ($keyWord) {
				$query
						->orWhere('IdDistrito', 'LIKE', $keyWord)
						->orWhere('IdServicio', 'LIKE', $keyWord)
						->orWhere('IdComite', 'LIKE', $keyWord)
						->orWhere('IdComiteCan', 'LIKE', $keyWord)
						->orWhere('servidor', 'LIKE', $keyWord)
						->orWhere('telefono', 'LIKE', $keyWord)
						->orWhere('asamblea1', 'LIKE', $keyWord)
						->orWhere('asamblea2', 'LIKE', $keyWord);
			})
			->paginate(10);
	}

	public function render()
	{
		return view('livewire.distritosservs.view', [
			'distritosservs' => $this->filteredDistritosservs,
		]);
	}
	
    public function cancel()
    {
        $this->verModalDistritosserv = false;
    }
    public function resetInput()
    {
        $this->reset();
    }
    public function edit($id)
    {
        $this->resetInput();
        $this->selected_id = $id;
		$this->fill(Distritosserv::findOrFail($id)->toArray());
        $this->verModalDistritosserv = true;
    }
    public function create()
    {
        $this->resetInput();
        $this->verModalDistritosserv = true;
    }    
    public function save()
    {
        $this->validate([
		'IdDistrito' => 'required',
		'IdServicio' => 'required',
		'IdComite' => 'required',
		'servidor' => 'required',
        ]);

        Distritosserv::updateOrCreate(
			['id' => $this->selected_id],
			[
				'IdDistrito' => $this-> IdDistrito,
				'IdServicio' => $this-> IdServicio,
				'IdComite' => $this-> IdComite,
				'IdComiteCan' => $this-> IdComiteCan,
				'servidor' => $this-> servidor,
				'telefono' => $this-> telefono,
				'asamblea1' => $this-> asamblea1,
				'asamblea2' => $this-> asamblea2
			]
		);
        $this->verModalDistritosserv = false;
    }

    public function destroy($id)
    {
        if ($id) {
            Distritosserv::where('id', $id)->delete();
        }
    }
}