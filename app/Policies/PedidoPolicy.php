<?php

namespace App\Policies;

use App\User;
use App\Pedido;
use Illuminate\Auth\Access\HandlesAuthorization;

class PedidoPolicy
{
    use HandlesAuthorization;

    public function before($user){
        if($user->hasRole('Administrador')){
            return true;
        }
    }
    
    /**
     * Determine whether the user can view any pedidos.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        //
    }

    /**
     * Determine whether the user can view the pedido.
     *
     * @param  \App\User  $user
     * @param  \App\Pedido  $pedido
     * @return mixed
     */
    public function view(User $user, Pedido $pedido)
    {
        return $user->hasRole('Administrador') || $user->hasPermissionTo('Ver pedidos');
    }

    /**
     * Determine whether the user can create pedidos.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        return $user->hasRole('Administrador') || $user->hasPermissionTo('Crear pedidos');
    }

    /**
     * Determine whether the user can update the pedido.
     *
     * @param  \App\User  $user
     * @param  \App\Pedido  $pedido
     * @return mixed
     */
    public function update(User $user, Pedido $pedido)
    {
        return $user->hasRole('Administrador') || $user->hasPermissionTo('Actualizar pedidos');
    }

    /**
     * Determine whether the user can delete the pedido.
     *
     * @param  \App\User  $user
     * @param  \App\Pedido  $pedido
     * @return mixed
     */
    public function delete(User $user, Pedido $pedido)
    {
        return $user->hasRole('Administrador') || $user->hasPermissionTo('Eliminar pedidos');
    }

    /**
     * Determine whether the user can restore the pedido.
     *
     * @param  \App\User  $user
     * @param  \App\Pedido  $pedido
     * @return mixed
     */
    public function restore(User $user, Pedido $pedido)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the pedido.
     *
     * @param  \App\User  $user
     * @param  \App\Pedido  $pedido
     * @return mixed
     */
    public function forceDelete(User $user, Pedido $pedido)
    {
        //
    }
}
