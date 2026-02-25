<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Pedido;
use Livewire\Attributes\Computed;
use App\Models\Util;
use Illuminate\Support\Facades\DB;

class Pedidos extends Component
{
    use WithPagination;

	protected $paginationTheme = 'bootstrap';
    public $verModalPedido=false, $selected_id, $keyWord, $IdUser, $IdCliente, $FechaH, $total, $totalArticulos, $estatus, $Obs, $adicionales;
	
    public function updatedKeyWord()
	{
		$this->resetPage();
	}
    #[Computed]
	public function filteredPedidos()
	{
		$keyWord = '%' . $this->keyWord . '%';
		return Pedido::Where('id','>',0)
			->where(function ($query) use ($keyWord) {
				$query
						->orWhere('IdUser', 'LIKE', $keyWord)
						->orWhere('IdCliente', 'LIKE', $keyWord)
						->orWhere('FechaH', 'LIKE', $keyWord)
						->orWhere('total', 'LIKE', $keyWord)
						->orWhere('totalArticulos', 'LIKE', $keyWord)
						->orWhere('estatus', 'LIKE', $keyWord)
						->orWhere('Obs', 'LIKE', $keyWord)
						->orWhere('adicionales', 'LIKE', $keyWord);
			})
			->paginate(12);
	}

	public function render()
	{
		return view('livewire.pedidos.view', [
			'pedidos' => $this->filteredPedidos,
		]);
	}
	
    public function cancel()
    {
        $this->resetInput();
        $this->verModalPedido = false;
    }

    public function resetInput()
    {
        $this->reset();
    }

    public function edit($id)
    {
        $this->selected_id = $id;
		$this->fill(Pedido::findOrFail($id)->toArray());
        $this->verModalPedido = true;
    }
    public function create()
    {
        $this->resetInput();
        $this->verModalPedido = true;
    }    
    public function save()
    {
        $this->validate([
		'IdUser' => 'required',
		'IdCliente' => 'required',
		'FechaH' => 'required',
        ]);

        Pedido::updateOrCreate(
			['id' => $this->selected_id],
			[
				'IdUser' => $this-> IdUser,
				'IdCliente' => $this-> IdCliente,
				'FechaH' => $this-> FechaH,
				'total' => $this-> total,
				'totalArticulos' => $this-> totalArticulos,
				'estatus' => $this-> estatus,
				'Obs' => $this-> Obs,
				'adicionales' => $this-> adicionales
			]
		);
        $this->resetInput();
        $this->verModalPedido = false;
    }

    public function destroy($id)
    {
        if ($id) {
            Pedido::where('id', $id)->delete();
        }
    }
}