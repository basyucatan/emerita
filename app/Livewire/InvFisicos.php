<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Traspaso;
use Livewire\Attributes\Computed;
use App\Traits\CrudTraspasos;

class InvFisicos extends Component
{
    use WithPagination, CrudTraspasos;

    protected $paginationTheme = 'bootstrap';
    public $keyWord;

	public function updatingKeyWord()
	{
		$this->resetPage();
	}

	#[Computed]
	public function filteredTraspasos()
	{
		$keyWord = '%' . $this->keyWord . '%';
		return Traspaso::where('tipo', 'InvFisico')
			->where('estatus', $this->queVer)
			->where(function ($query) use ($keyWord) {
				$query
					->orWhereHas('userOri', fn($q) => $q->where('name', 'LIKE', "%{$keyWord}%"))
					->orWhereHas('userDes', fn($q) => $q->where('name', 'LIKE', "%{$keyWord}%"))
					->orWhereHas('deptoOri', fn($q) => $q->where('depto', 'LIKE', "%{$keyWord}%"))
					->orWhereHas('deptoDes', fn($q) => $q->where('depto', 'LIKE', "%{$keyWord}%"))
					->orWhere('adicionales->obs', 'LIKE', "%{$keyWord}%");
			})
			->orderBy('fecha', $this->orden)
			->paginate(3);
	}

    public function render()
    {
        return view('livewire.invfisicos.view', [
            'traspasos' => $this->filteredTraspasos,
        ]);
    }
}
