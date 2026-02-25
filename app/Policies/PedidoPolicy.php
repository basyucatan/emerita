<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Pedido;
use App\Models\Pedidosdet;

class PedidoPolicy
{
    public function create(User $user)
    {
        return !$user->pedidos()
            ->where('estatus', 'carrito')
            ->exists();
    }

    public function update(User $user, Pedido $pedido)
    {
        $esPrivilegiado =
            $user->hasRole('Admin') ||
            $user->hasRole('Gerente') ||
            $user->hasRole('SuperAdmin');
        $esDueno = $user->id === $pedido->IdUser;
        if ($esPrivilegiado) {
            return in_array($pedido->estatus, ['carrito', 'confirmado']);
        }
        if ($esDueno) {
            return $pedido->estatus === 'carrito';
        }
        return false;
    }
    
    public function confirmar(User $user, Pedido $pedido)
    {
        return $pedido->estatus === 'carrito';
    }

    public function recibir(User $user, Pedido $pedido)
    {
        return $user->hasAnyRole(['Admin','Gerente','SuperAdmin'])
            && $pedido->estatus === 'confirmado';
    }

    public function delete(User $user, Pedido $pedido)
    {
        if ($user->hasRole('Admin') || 
            $user->hasRole('Gerente') || 
            $user->hasRole('SuperAdmin')) {
            return true;
        }

        return $user->id === $pedido->IdUser
            && $pedido->estatus === 'carrito';
    }


    public function createDetalle(User $user, Pedido $pedido)
    {
        if (!$this->update($user, $pedido)) {
            return false;
        }

        return $pedido->estatus === 'carrito';
    }

    public function updateDetalle(User $user, Pedidosdet $detalle)
    {
        return $this->update($user, $detalle->pedido);
    }

    public function deleteDetalle(User $user, Pedidosdet $detalle)
    {
        return $this->delete($user, $detalle->pedido);
    }

    public function viewAny(User $user)
    {
        return $user->hasRole('Admin')
            || $user->hasRole('Gerente')
            || $user->hasRole('SuperAdmin');

    }

    public function view(User $user, Pedido $pedido)
    {
        return $user->id === $pedido->IdUser
            || $user->hasRole('Admin')
            || $user->hasRole('Gerente')
            || $user->hasRole('SuperAdmin');
    }

}
