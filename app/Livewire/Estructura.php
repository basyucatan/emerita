<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Distrito;
use App\Models\Grupo;

class Estructura extends Component
{
    use WithPagination;

	protected $paginationTheme = 'bootstrap';
	public function render()
	{
		return view('livewire.estructura.view');
	}

}