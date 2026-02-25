<?php

namespace App\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use App\Models\Pedido;
use App\Models\Pedidosdet;
use Illuminate\Support\Facades\Gate;
use Barryvdh\DomPDF\Facade\Pdf as PDF;

class Welcome extends Component
{
    public $IdCliente, $Pedido, $pedidos;

    protected $listeners = ['IdPedidoEnHijo' => 'elegirPedido'];

    // public function elegirPedido($id)
    // {       
    //     $this->Pedido = Pedido::find($id);
    //     $this->dispatch('IdPedidoElegido', $id);
    // }


    public function render()
    {
        return view('livewire.welcome.view');
    }
  
}
