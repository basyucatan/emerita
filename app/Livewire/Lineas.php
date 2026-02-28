<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Linea;
use Livewire\Attributes\Computed;
use App\Models\Util;
use Illuminate\Support\Facades\DB;

class Lineas extends Component
{
    use WithPagination;

	protected $paginationTheme = 'bootstrap';
    public $verModalLinea=false, $selected_id, $keyWord, $IdMarca, $IdDivision, 
    $IdColorablePerfil, $linea, $orden;
    public $marcas=[], $colorables=[], $divisions=[];

	public function updatingKeyWord()
	{
		$this->resetPage();
	}
    #[Computed]
	public function filteredLineas()
	{
		$keyWord = '%' . $this->keyWord . '%';
        $resultado = Linea::where('id', '>', 0)
            ->where(function ($query) use ($keyWord) {
                $query->where('linea', 'LIKE', $keyWord)
                    ->orWhere('orden', 'LIKE', $keyWord)
                    ->orWhereHas('marca', function ($q) use ($keyWord) {
                        $q->where('marca', 'LIKE', $keyWord);
                    })
                    ->orWhereHas('Division', function ($q) use ($keyWord) {
                        $q->where('division', 'LIKE', $keyWord);
                    });
            })
            ->orderBy('linea', 'asc')
            ->paginate(10);
        return $resultado;
	}

	public function render()
	{
		return view('livewire.lineas.view', [
			'lineas' => $this->filteredLineas,
		]);
	}

    public function mount()
    {
        $this->marcas = Util::getArray('marcas');
        $this->colorables = Util::getArray('colorables');
        $this->divisions = Util::getArray('divisions');
    }

    public function cancel()
    {
        $this->resetInput();
        $this->verModalLinea = false;
    }
    public function resetInput()
    {
        $this->resetExcept('marcas', 'colorables', 'divisions');
    }
    public function edit($id)
    {
        $this->selected_id = $id;
		$this->fill(Linea::findOrFail($id)->toArray());
        $this->verModalLinea = true;
    }
    public function create()
    {
        $this->resetInput();
        $this->verModalLinea = true;
    }    
    public function save()
    {
        $this->validate([
		'IdMarca' => 'required',
		'IdDivision' => 'required',
		'linea' => 'required',
		'orden' => 'required',
        ]);

        Linea::updateOrCreate(
			['id' => $this->selected_id],
			[
				'IdMarca' => $this-> IdMarca,
				'IdDivision' => $this-> IdDivision,
				'IdColorablePerfil' => $this-> IdColorablePerfil ? : null,
				'linea' => $this-> linea,
				'orden' => $this-> orden
			]
		);
        $this->resetInput();
        $this->verModalLinea = false;
    }

    public function destroy($id)
    {
        if ($id) {
            Linea::where('id', $id)->delete();
        }
    }
}