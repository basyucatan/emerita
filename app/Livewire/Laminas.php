<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Lamina;
use Livewire\Attributes\Computed;
use App\Models\Util;
use Illuminate\Support\Facades\DB;

class Laminas extends Component
{
    use WithPagination;

	protected $paginationTheme = 'bootstrap';
    public $verModalLamina=false, $selected_id, $keyWord, $lamina, $codigo, $codigoCinta, $pesoML, $calibre, $dUtil;
	
    public function updatedKeyWord()
	{
		$this->resetPage();
	}
    #[Computed]
	public function filteredLaminas()
	{
		$keyWord = '%' . $this->keyWord . '%';
		return Lamina::Where('id','>',0)
			->where(function ($query) use ($keyWord) {
				$query
						->orWhere('lamina', 'LIKE', $keyWord)
						->orWhere('codigo', 'LIKE', $keyWord)
						->orWhere('codigoCinta', 'LIKE', $keyWord)
						->orWhere('pesoML', 'LIKE', $keyWord)
						->orWhere('calibre', 'LIKE', $keyWord)
						->orWhere('dUtil', 'LIKE', $keyWord);
			})
			->paginate(12);
	}

	public function render()
	{
		return view('livewire.laminas.view', [
			'laminas' => $this->filteredLaminas,
		]);
	}
	
    public function cancel()
    {
        $this->resetInput();
        $this->verModalLamina = false;
    }

    public function resetInput()
    {
        $this->reset();
    }

    public function edit($id)
    {
        $this->selected_id = $id;
		$this->fill(Lamina::findOrFail($id)->toArray());
        $this->verModalLamina = true;
    }
    public function create()
    {
        $this->resetInput();
        $this->verModalLamina = true;
    }    
    public function save()
    {
        $this->validate([
		'lamina' => 'required',
		'codigo' => 'required',
		'codigoCinta' => 'required',
		'pesoML' => 'required',
		'calibre' => 'required',
		'dUtil' => 'required',
        ]);

        Lamina::updateOrCreate(
			['id' => $this->selected_id],
			[
				'lamina' => $this-> lamina,
				'codigo' => $this-> codigo,
				'codigoCinta' => $this-> codigoCinta,
				'pesoML' => $this-> pesoML,
				'calibre' => $this-> calibre,
				'dUtil' => $this-> dUtil
			]
		);
        $this->resetInput();
        $this->verModalLamina = false;
    }

    public function destroy($id)
    {
        if ($id) {
            Lamina::where('id', $id)->delete();
        }
    }
}