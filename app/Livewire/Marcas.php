<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Marca;
use App\Models\Util;
use Livewire\Attributes\Computed;

class Marcas extends Component
{
    use WithPagination;

	protected $paginationTheme = 'bootstrap';
    public $verModalMarca=false, $selected_id, $keyWord, $marca, $IdColorable, $foto;
    public $colorables = [];
    #[Computed]
	public function filteredMarcas()
	{
		$keyWord = '%' . $this->keyWord . '%';
		return Marca::Where('id','>',0)
			->where(function ($query) use ($keyWord) {
				$query
						->orWhere('marca', 'LIKE', $keyWord)
						->orWhere('IdColorable', 'LIKE', $keyWord)
						->orWhere('foto', 'LIKE', $keyWord);
			})
			->paginate(10);
	}
	public function mount(){
        $this->colorables = Util::getArray('colorables');
    }
	public function render()
	{
        // $condsPago = Util::getArrayJS('condicionesPago','condicion');
		return view('livewire.marcas.view', [
			'marcas' => $this->filteredMarcas,
		]);
	}
	
    public function cancel()
    {
        $this->reset();
        $this->verModalMarca = false;
    }

    public function edit($id)
    {
        $this->selected_id = $id;
		$this->fill(Marca::findOrFail($id)->toArray());
        $this->verModalMarca = true;
    }
    public function create()
    {
        $this->reset();
        $this->verModalMarca = true;
    }    
    public function save()
    {
        $this->validate([
		'marca' => 'required',
        ]);

        Marca::updateOrCreate(
			['id' => $this->selected_id],
			[
				'marca' => $this-> marca,
				'IdColorable' => $this-> IdColorable,
				'foto' => $this-> foto
			]
		);
        $this->reset();
        $this->verModalMarca = false;
    }

    public function destroy($id)
    {
        if ($id) {
            Marca::where('id', $id)->delete();
        }
    }
}