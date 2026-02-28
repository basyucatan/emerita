<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Tipo;
use Livewire\Attributes\Computed;
use App\Models\Util;
use Illuminate\Support\Facades\DB;

class Tipos extends Component
{
    use WithPagination;

	protected $paginationTheme = 'bootstrap';
    public $verModalTipo=false, $selected_id, $keyWord, $tipo, $orden;

    #[Computed]
	public function filteredTipos()
	{
		$keyWord = '%' . $this->keyWord . '%';
		return Tipo::Where('id','>',0)
			->where(function ($query) use ($keyWord) {
				$query
						->orWhere('tipo', 'LIKE', $keyWord)
						->orWhere('orden', 'LIKE', $keyWord);
			})
			->paginate(10);
	}

	public function render()
	{
		return view('livewire.tipos.view', [
			'tipos' => $this->filteredTipos,
		]);
	}
	
    public function cancel()
    {
        $this->reset();
        $this->verModalTipo = false;
    }

    public function edit($id)
    {
        $this->selected_id = $id;
		$this->fill(Tipo::findOrFail($id)->toArray());
        $this->verModalTipo = true;
    }
    public function create()
    {
        $this->reset();
        $this->verModalTipo = true;
    }    
    public function save()
    {
        $this->validate([
		'tipo' => 'required',
		'orden' => 'required',
        ]);

        Tipo::updateOrCreate(
			['id' => $this->selected_id],
			[
				'tipo' => $this-> tipo,
				'orden' => $this-> orden
			]
		);
        $this->reset();
        $this->verModalTipo = false;
    }

    public function destroy($id)
    {
        if ($id) {
            Tipo::where('id', $id)->delete();
        }
    }
}