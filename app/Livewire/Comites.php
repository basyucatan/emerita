<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Comite;
use Livewire\Attributes\Computed;
use App\Models\Util;
use Illuminate\Support\Facades\DB;

class Comites extends Component
{
    use WithPagination;

	protected $paginationTheme = 'bootstrap';
    public $verModalComite=false, $selected_id, $keyWord, $comite, $abreviatura, $orden, $comAsamblea;
	
    public function updatedKeyWord()
	{
		$this->resetPage();
	}
    #[Computed]
	public function filteredComites()
	{
		$keyWord = '%' . $this->keyWord . '%';
		return Comite::Where('id','>',0)
			->where(function ($query) use ($keyWord) {
				$query
						->orWhere('comite', 'LIKE', $keyWord)
						->orWhere('abreviatura', 'LIKE', $keyWord)
						->orWhere('orden', 'LIKE', $keyWord)
						->orWhere('comAsamblea', 'LIKE', $keyWord);
			})
			->paginate(12);
	}

	public function render()
	{
		return view('livewire.comites.view', [
			'comites' => $this->filteredComites,
		]);
	}
	
    public function cancel()
    {
        $this->resetInput();
        $this->verModalComite = false;
    }

    public function resetInput()
    {
        $this->reset();
    }

    public function edit($id)
    {
        $this->selected_id = $id;
		$this->fill(Comite::findOrFail($id)->toArray());
        $this->verModalComite = true;
    }
    public function create()
    {
        $this->resetInput();
        $this->verModalComite = true;
    }    
    public function save()
    {
        $this->validate([
		'comite' => 'required',
		'abreviatura' => 'required',
		'orden' => 'required',
        ]);

        Comite::updateOrCreate(
			['id' => $this->selected_id],
			[
				'comite' => $this-> comite,
				'abreviatura' => $this-> abreviatura,
				'orden' => $this-> orden,
				'comAsamblea' => $this-> comAsamblea
			]
		);
        $this->resetInput();
        $this->verModalComite = false;
    }

    public function destroy($id)
    {
        if ($id) {
            Comite::where('id', $id)->delete();
        }
    }
}