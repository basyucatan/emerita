<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Barra;
use Livewire\Attributes\Computed;
use App\Models\Util;
use Illuminate\Support\Facades\DB;

class Barras extends Component
{
    use WithPagination;

	protected $paginationTheme = 'bootstrap';
    public $verModalBarra=false, $selected_id, $keyWord, $longitud, $descripcion;

    #[Computed]
	public function filteredBarras()
	{
		$keyWord = '%' . $this->keyWord . '%';
		return Barra::Where('id','>',0)
			->where(function ($query) use ($keyWord) {
				$query
						->orWhere('longitud', 'LIKE', $keyWord)
						->orWhere('descripcion', 'LIKE', $keyWord);
			})
			->paginate(10);
	}

	public function render()
	{
		return view('livewire.barras.view', [
			'barras' => $this->filteredBarras,
		]);
	}
	
    public function cancel()
    {
        $this->reset();
        $this->verModalBarra = false;
    }

    public function edit($id)
    {
        $this->selected_id = $id;
		$this->fill(Barra::findOrFail($id)->toArray());
        $this->verModalBarra = true;
    }
    public function create()
    {
        $this->reset();
        $this->verModalBarra = true;
    }    
    public function save()
    {
        $this->validate([
		'longitud' => 'required',
        ]);

        Barra::updateOrCreate(
			['id' => $this->selected_id],
			[
				'longitud' => $this-> longitud,
				'descripcion' => $this-> descripcion
			]
		);
        $this->reset();
        $this->verModalBarra = false;
    }

    public function destroy($id)
    {
        if ($id) {
            Barra::where('id', $id)->delete();
        }
    }
}