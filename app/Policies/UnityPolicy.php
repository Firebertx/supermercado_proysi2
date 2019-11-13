<?php

namespace App\Policies;

use App\User;
use App\Unity;
use Illuminate\Auth\Access\HandlesAuthorization;

class UnityPolicy
{
    use HandlesAuthorization;

    public function before($user){
        if($user->hasRole('Administrador')){
            return true;
        }
    }
    
    /**
     * Determine whether the user can view any unities.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        //
    }

    /**
     * Determine whether the user can view the unity.
     *
     * @param  \App\User  $user
     * @param  \App\Unity  $unity
     * @return mixed
     */
    public function view(User $user, Unity $unity)
    {
        return $user->hasRole('Administrador') || $user->hasPermissionTo('Ver unidades');
    }

    /**
     * Determine whether the user can create unities.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        return $user->hasRole('Administrador') || $user->hasPermissionTo('Crear unidades');
    }

    /**
     * Determine whether the user can update the unity.
     *
     * @param  \App\User  $user
     * @param  \App\Unity  $unity
     * @return mixed
     */
    public function update(User $user, Unity $unity)
    {
        return $user->hasRole('Administrador') || $user->hasPermissionTo('Actualizar unidades');
    }

    /**
     * Determine whether the user can delete the unity.
     *
     * @param  \App\User  $user
     * @param  \App\Unity  $unity
     * @return mixed
     */
    public function delete(User $user, Unity $unity)
    {
        return $user->hasRole('Administrador') || $user->hasPermissionTo('Eliminar unidades');
    }

    /**
     * Determine whether the user can restore the unity.
     *
     * @param  \App\User  $user
     * @param  \App\Unity  $unity
     * @return mixed
     */
    public function restore(User $user, Unity $unity)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the unity.
     *
     * @param  \App\User  $user
     * @param  \App\Unity  $unity
     * @return mixed
     */
    public function forceDelete(User $user, Unity $unity)
    {
        //
    }
}
