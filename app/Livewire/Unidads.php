<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Unidad;
use Livewire\Attributes\Computed;
use App\Models\Util;
use Illuminate\Support\Facades\DB;

class Unidads extends Component
{
    use WithPagination;

	protected $paginationTheme = 'bootstrap';
    public $verModalUnidad=false, $selected_id, $keyWord, $tipo, $tipos,
        $unidad, $abreviatura, $factorConversion;

    #[Computed]
	public function filteredUnidads()
	{
		$keyWord = '%' . $this->keyWord . '%';
		return Unidad::Where('id','>',0)
			->where(function ($query) use ($keyWord) {
				$query
						->orWhere('tipo', 'LIKE', $keyWord)
						->orWhere('unidad', 'LIKE', $keyWord)
						->orWhere('abreviatura', 'LIKE', $keyWord)
						->orWhere('factorConversion', 'LIKE', $keyWord);
			})
			->paginate(10);
	}

	public function render()
	{
        if (empty($this->tipos))
            $this->tipos = Util::getArray('unidads','tipo');
		return view('livewire.unidads.view', [
			'unidads' => $this->filteredUnidads,
		]);
	}
	
    public function cancel()
    {
        $this->reset();
        $this->verModalUnidad = false;
    }

    public function edit($id)
    {
        $this->selected_id = $id;
		$this->fill(Unidad::findOrFail($id)->toArray());
        $this->verModalUnidad = true;
    }
    public function create()
    {
        $this->reset();
        $this->verModalUnidad = true;
    }    
    public function save()
    {
        $this->validate([
		'tipo' => 'required',
		'unidad' => 'required',
		'abreviatura' => 'required',
		'factorConversion' => 'required',
        ]);

        Unidad::updateOrCreate(
			['id' => $this->selected_id],
			[
				'tipo' => $this-> tipo,
				'unidad' => $this-> unidad,
				'abreviatura' => $this-> abreviatura,
				'factorConversion' => $this-> factorConversion
			]
		);
        $this->reset();
        $this->verModalUnidad = false;
    }

    public function destroy($id)
    {
        if ($id) {
            Unidad::where('id', $id)->delete();
        }
    }
}