<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Vidrio;
use Livewire\Attributes\Computed;
use App\Models\Util;
use Illuminate\Support\Facades\DB;

class Vidrios extends Component
{
    use WithPagination;

	protected $paginationTheme = 'bootstrap';
    public $verModalVidrio=false, $selected_id, $keyWord, $vidrio, $grosor;
	
    public function updatedKeyWord()
	{
		$this->resetPage();
	}
    #[Computed]
	public function filteredVidrios()
	{
		$keyWord = '%' . $this->keyWord . '%';
		return Vidrio::Where('id','>',0)
			->where(function ($query) use ($keyWord) {
				$query
						->orWhere('vidrio', 'LIKE', $keyWord)
						->orWhere('grosor', 'LIKE', $keyWord);
			})
			->paginate(12);
	}

	public function render()
	{
		return view('livewire.vidrios.view', [
			'vidrios' => $this->filteredVidrios,
		]);
	}
	
    public function cancel()
    {
        $this->resetInput();
        $this->verModalVidrio = false;
    }

    public function resetInput()
    {
        $this->reset();
    }

    public function edit($id)
    {
        $this->selected_id = $id;
		$this->fill(Vidrio::findOrFail($id)->toArray());
        $this->verModalVidrio = true;
    }
    public function create()
    {
        $this->resetInput();
        $this->verModalVidrio = true;
    }    
    public function save()
    {
        $this->validate([
		'vidrio' => 'required',
		'grosor' => 'required',
        ]);

        Vidrio::updateOrCreate(
			['id' => $this->selected_id],
			[
				'vidrio' => $this-> vidrio,
				'grosor' => $this-> grosor
			]
		);
        $this->resetInput();
        $this->verModalVidrio = false;
    }

    public function destroy($id)
    {
        if ($id) {
            Vidrio::where('id', $id)->delete();
        }
    }
}