<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Guia;
use Livewire\Attributes\Computed;
use App\Models\Util;
use Illuminate\Support\Facades\DB;

class Guias extends Component
{
    use WithPagination;

	protected $paginationTheme = 'bootstrap';
    public $verModalGuia=false, $selected_id, $keyWord, $guia, $IdMaterial;
	
    public function updatedKeyWord()
	{
		$this->resetPage();
	}
    #[Computed]
	public function filteredGuias()
	{
		$keyWord = '%' . $this->keyWord . '%';
		return Guia::Where('id','>',0)
			->where(function ($query) use ($keyWord) {
				$query
						->orWhere('guia', 'LIKE', $keyWord)
						->orWhere('IdMaterial', 'LIKE', $keyWord);
			})
			->paginate(12);
	}

	public function render()
	{
		return view('livewire.guias.view', [
			'guias' => $this->filteredGuias,
		]);
	}
	
    public function cancel()
    {
        $this->resetInput();
        $this->verModalGuia = false;
    }

    public function resetInput()
    {
        $this->reset();
    }

    public function edit($id)
    {
        $this->selected_id = $id;
		$this->fill(Guia::findOrFail($id)->toArray());
        $this->verModalGuia = true;
    }
    public function create()
    {
        $this->resetInput();
        $this->verModalGuia = true;
    }    
    public function save()
    {
        $this->validate([
		'guia' => 'required',
        ]);

        Guia::updateOrCreate(
			['id' => $this->selected_id],
			[
				'guia' => $this-> guia,
				'IdMaterial' => $this-> IdMaterial
			]
		);
        $this->resetInput();
        $this->verModalGuia = false;
    }

    public function destroy($id)
    {
        if ($id) {
            Guia::where('id', $id)->delete();
        }
    }
}