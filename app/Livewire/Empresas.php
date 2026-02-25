<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Empresa;
use Livewire\Attributes\Computed;
use App\Models\Util;
use Illuminate\Support\Facades\DB;

class Empresas extends Component
{
    use WithPagination;

	protected $paginationTheme = 'bootstrap';
    public $verModalEmpresa=false, $selected_id, $keyWord, $IdNegocio, $tipo, $empresa, $direccion, $gmaps, $telefono, $email, $adicionales;
	
    public function updatedKeyWord()
	{
		$this->resetPage();
	}
    #[Computed]
	public function filteredEmpresas()
	{
		$keyWord = '%' . $this->keyWord . '%';
		return Empresa::Where('id','>',0)
			->where(function ($query) use ($keyWord) {
				$query
						->orWhere('IdNegocio', 'LIKE', $keyWord)
						->orWhere('tipo', 'LIKE', $keyWord)
						->orWhere('empresa', 'LIKE', $keyWord)
						->orWhere('direccion', 'LIKE', $keyWord)
						->orWhere('gmaps', 'LIKE', $keyWord)
						->orWhere('telefono', 'LIKE', $keyWord)
						->orWhere('email', 'LIKE', $keyWord)
						->orWhere('adicionales', 'LIKE', $keyWord);
			})
			->paginate(12);
	}

	public function render()
	{
		return view('livewire.empresas.view', [
			'empresas' => $this->filteredEmpresas,
		]);
	}
	
    public function cancel()
    {
        $this->resetInput();
        $this->verModalEmpresa = false;
    }

    public function resetInput()
    {
        $this->reset();
    }

    public function edit($id)
    {
        $this->selected_id = $id;
		$this->fill(Empresa::findOrFail($id)->toArray());
        $this->verModalEmpresa = true;
    }
    public function create()
    {
        $this->resetInput();
        $this->verModalEmpresa = true;
    }    
    public function save()
    {
        $this->validate([
		'tipo' => 'required',
		'empresa' => 'required',
        ]);

        Empresa::updateOrCreate(
			['id' => $this->selected_id],
			[
				'IdNegocio' => $this-> IdNegocio,
				'tipo' => $this-> tipo,
				'empresa' => $this-> empresa,
				'direccion' => $this-> direccion,
				'gmaps' => $this-> gmaps,
				'telefono' => $this-> telefono,
				'email' => $this-> email,
				'adicionales' => $this-> adicionales
			]
		);
        $this->resetInput();
        $this->verModalEmpresa = false;
    }

    public function destroy($id)
    {
        if ($id) {
            Empresa::where('id', $id)->delete();
        }
    }
}