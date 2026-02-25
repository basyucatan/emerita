<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Pedidosdet;
use Livewire\Attributes\Computed;
use App\Models\Util;
use Illuminate\Support\Facades\DB;

class Pedidosdets extends Component
{
    use WithPagination;

	protected $paginationTheme = 'bootstrap';
    public $verModalPedidosdet=false, $selected_id, $keyWord, $IdPedido, $IdProducto, $cantidad, $precioU;
	
    public function updatedKeyWord()
	{
		$this->resetPage();
	}
    #[Computed]
	public function filteredPedidosdets()
	{
		$keyWord = '%' . $this->keyWord . '%';
		return Pedidosdet::Where('id','>',0)
			->where(function ($query) use ($keyWord) {
				$query
						->orWhere('IdPedido', 'LIKE', $keyWord)
						->orWhere('IdProducto', 'LIKE', $keyWord)
						->orWhere('cantidad', 'LIKE', $keyWord)
						->orWhere('precioU', 'LIKE', $keyWord);
			})
			->paginate(12);
	}

	public function render()
	{
		return view('livewire.pedidosdets.view', [
			'pedidosdets' => $this->filteredPedidosdets,
		]);
	}
	
    public function cancel()
    {
        $this->resetInput();
        $this->verModalPedidosdet = false;
    }

    public function resetInput()
    {
        $this->reset();
    }

    public function edit($id)
    {
        $this->selected_id = $id;
		$this->fill(Pedidosdet::findOrFail($id)->toArray());
        $this->verModalPedidosdet = true;
    }
    public function create()
    {
        $this->resetInput();
        $this->verModalPedidosdet = true;
    }    
    public function save()
    {
        $this->validate([
		'IdPedido' => 'required',
		'IdProducto' => 'required',
		'cantidad' => 'required',
		'precioU' => 'required',
        ]);

        Pedidosdet::updateOrCreate(
			['id' => $this->selected_id],
			[
				'IdPedido' => $this-> IdPedido,
				'IdProducto' => $this-> IdProducto,
				'cantidad' => $this-> cantidad,
				'precioU' => $this-> precioU
			]
		);
        $this->resetInput();
        $this->verModalPedidosdet = false;
    }

    public function destroy($id)
    {
        if ($id) {
            Pedidosdet::where('id', $id)->delete();
        }
    }
}