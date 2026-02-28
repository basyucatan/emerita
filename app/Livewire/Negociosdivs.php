<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Negociosdiv;
use Livewire\Attributes\Computed;
use App\Models\Util;
use Illuminate\Support\Facades\DB;

class Negociosdivs extends Component
{
    use WithPagination;

	protected $paginationTheme = 'bootstrap';
    public $verModalNegociosdiv=false, $selected_id, $keyWord, $IdNegocio, $division;
	
    public function updatedKeyWord()
	{
		$this->resetPage();
	}
    #[Computed]
	public function filteredNegociosdivs()
	{
		$keyWord = '%' . $this->keyWord . '%';
		return Negociosdiv::Where('id','>',0)
			->where(function ($query) use ($keyWord) {
				$query
						->orWhere('IdNegocio', 'LIKE', $keyWord)
						->orWhere('division', 'LIKE', $keyWord);
			})
			->paginate(12);
	}

	public function render()
	{
		return view('livewire.negociosdivs.view', [
			'negociosdivs' => $this->filteredNegociosdivs,
		]);
	}
	
    public function cancel()
    {
        $this->resetInput();
        $this->verModalNegociosdiv = false;
    }

    public function resetInput()
    {
        $this->reset();
    }

    public function edit($id)
    {
        $this->selected_id = $id;
		$this->fill(Negociosdiv::findOrFail($id)->toArray());
        $this->verModalNegociosdiv = true;
    }
    public function create()
    {
        $this->resetInput();
        $this->verModalNegociosdiv = true;
    }    
    public function save()
    {
        $this->validate([
		'IdNegocio' => 'required',
		'division' => 'required',
        ]);

        Negociosdiv::updateOrCreate(
			['id' => $this->selected_id],
			[
				'IdNegocio' => $this-> IdNegocio,
				'division' => $this-> division
			]
		);
        $this->resetInput();
        $this->verModalNegociosdiv = false;
    }

    public function destroy($id)
    {
        if ($id) {
            Negociosdiv::where('id', $id)->delete();
        }
    }
}