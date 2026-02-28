<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Colorable;
use Livewire\Attributes\Computed;
use App\Models\Util;
use Illuminate\Support\Facades\DB;

class Colorables extends Component
{
    use WithPagination;

	protected $paginationTheme = 'bootstrap';
    public $verModalColorable=false, $selected_id, $keyWord, $colorable, $tipo;

    #[Computed]
	public function filteredColorables()
	{
		$keyWord = '%' . $this->keyWord . '%';
		return Colorable::Where('id','>',0)
			->where(function ($query) use ($keyWord) {
				$query
						->orWhere('colorable', 'LIKE', $keyWord)
						->orWhere('tipo', 'LIKE', $keyWord);
			})
			->paginate(10);
	}

	public function render()
	{
		return view('livewire.colorables.view', [
			'colorables' => $this->filteredColorables,
		]);
	}
	
    public function cancel()
    {
        $this->reset();
        $this->verModalColorable = false;
    }

    public function edit($id)
    {
        $this->selected_id = $id;
		$this->fill(Colorable::findOrFail($id)->toArray());
        $this->verModalColorable = true;
    }
    public function create()
    {
        $this->reset();
        $this->verModalColorable = true;
    }    
    public function save()
    {
        $this->validate([
		'colorable' => 'required',
		'tipo' => 'required',
        ]);

        Colorable::updateOrCreate(
			['id' => $this->selected_id],
			[
				'colorable' => $this-> colorable,
				'tipo' => $this-> tipo
			]
		);
        $this->reset();
        $this->verModalColorable = false;
    }

    public function destroy($id)
    {
        if ($id) {
            Colorable::where('id', $id)->delete();
        }
    }
}