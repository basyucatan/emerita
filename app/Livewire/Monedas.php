<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Moneda;
use Livewire\Attributes\Computed;
use App\Models\Util;
use Illuminate\Support\Facades\DB;

class Monedas extends Component
{
    use WithPagination;

	protected $paginationTheme = 'bootstrap';
    public $verModalMoneda=false, $selected_id, $keyWord, $moneda, $centavos, $simbolo, $abreviatura, $tipoCambio;

    #[Computed]
	public function filteredMonedas()
	{
		$keyWord = '%' . $this->keyWord . '%';
		return Moneda::Where('id','>',0)
			->where(function ($query) use ($keyWord) {
				$query
						->orWhere('moneda', 'LIKE', $keyWord)
						->orWhere('centavos', 'LIKE', $keyWord)
						->orWhere('simbolo', 'LIKE', $keyWord)
						->orWhere('abreviatura', 'LIKE', $keyWord)
						->orWhere('tipoCambio', 'LIKE', $keyWord);
			})
			->paginate(10);
	}

	public function render()
	{
		return view('livewire.monedas.view', [
			'monedas' => $this->filteredMonedas,
		]);
	}
	
    public function cancel()
    {
        $this->reset();
        $this->verModalMoneda = false;
    }

    public function edit($id)
    {
        $this->selected_id = $id;
		$this->fill(Moneda::findOrFail($id)->toArray());
        $this->verModalMoneda = true;
    }
    public function create()
    {
        $this->reset();
        $this->verModalMoneda = true;
    }    
    public function save()
    {
        $this->validate([
		'moneda' => 'required',
		'centavos' => 'required',
		'simbolo' => 'required',
		'abreviatura' => 'required',
		'tipoCambio' => 'required',
        ]);

        Moneda::updateOrCreate(
			['id' => $this->selected_id],
			[
				'moneda' => $this-> moneda,
				'centavos' => $this-> centavos,
				'simbolo' => $this-> simbolo,
				'abreviatura' => $this-> abreviatura,
				'tipoCambio' => $this-> tipoCambio
			]
		);
        $this->reset();
        $this->verModalMoneda = false;
    }

    public function destroy($id)
    {
        if ($id) {
            Moneda::where('id', $id)->delete();
        }
    }
}