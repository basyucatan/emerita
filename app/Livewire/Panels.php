<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Panel;
use Livewire\Attributes\Computed;
use App\Models\Util;
use Illuminate\Support\Facades\DB;

class Panels extends Component
{
    use WithPagination;

	protected $paginationTheme = 'bootstrap';
    public $verModalPanel=false, $selected_id, $keyWord, $panel, $ancho, $alto;

    #[Computed]
	public function filteredPanels()
	{
		$keyWord = '%' . $this->keyWord . '%';
		return Panel::Where('id','>',0)
			->where(function ($query) use ($keyWord) {
				$query
						->orWhere('panel', 'LIKE', $keyWord)
						->orWhere('ancho', 'LIKE', $keyWord)
						->orWhere('alto', 'LIKE', $keyWord);
			})
			->paginate(10);
	}

	public function render()
	{
		return view('livewire.panels.view', [
			'panels' => $this->filteredPanels,
		]);
	}
	
    public function cancel()
    {
        $this->reset();
        $this->verModalPanel = false;
    }

    public function edit($id)
    {
        $this->selected_id = $id;
		$this->fill(Panel::findOrFail($id)->toArray());
        $this->verModalPanel = true;
    }
    public function create()
    {
        $this->reset();
        $this->verModalPanel = true;
    }    
    public function save()
    {
        $this->validate([
		'panel' => 'required',
		'ancho' => 'required',
		'alto' => 'required',
        ]);

        Panel::updateOrCreate(
			['id' => $this->selected_id],
			[
				'panel' => $this-> panel,
				'ancho' => $this-> ancho,
				'alto' => $this-> alto
			]
		);
        $this->reset();
        $this->verModalPanel = false;
    }

    public function destroy($id)
    {
        if ($id) {
            Panel::where('id', $id)->delete();
        }
    }
}