<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Negocio;
use Livewire\Attributes\Computed;
use App\Models\Util;
use Illuminate\Support\Facades\DB;

class Negocios extends Component
{
    use WithPagination;

	protected $paginationTheme = 'bootstrap';
    public $verModalNegocio=false, $selected_id, $keyWord, $negocio, $razonSocial, $logo, $adicionales;
	
    public function updatedKeyWord()
	{
		$this->resetPage();
	}
    #[Computed]
	public function filteredNegocios()
	{
		$keyWord = '%' . $this->keyWord . '%';
		return Negocio::Where('id','>',0)
			->where(function ($query) use ($keyWord) {
				$query
						->orWhere('negocio', 'LIKE', $keyWord)
						->orWhere('razonSocial', 'LIKE', $keyWord)
						->orWhere('logo', 'LIKE', $keyWord)
						->orWhere('adicionales', 'LIKE', $keyWord);
			})
			->paginate(12);
	}

	public function render()
	{
		return view('livewire.negocios.view', [
			'negocios' => $this->filteredNegocios,
		]);
	}
	
    public function cancel()
    {
        $this->resetInput();
        $this->verModalNegocio = false;
    }

    public function resetInput()
    {
        $this->reset();
    }

    public function edit($id)
    {
        $this->selected_id = $id;
		$this->fill(Negocio::findOrFail($id)->toArray());
        $this->verModalNegocio = true;
    }
    public function create()
    {
        $this->resetInput();
        $this->verModalNegocio = true;
    }    
    public function save()
    {
        $this->validate([
		'negocio' => 'required',
        ]);

        Negocio::updateOrCreate(
			['id' => $this->selected_id],
			[
				'negocio' => $this-> negocio,
				'razonSocial' => $this-> razonSocial,
				'logo' => $this-> logo,
				'adicionales' => $this-> adicionales
			]
		);
        $this->resetInput();
        $this->verModalNegocio = false;
    }

    public function destroy($id)
    {
        if ($id) {
            Negocio::where('id', $id)->delete();
        }
    }
}