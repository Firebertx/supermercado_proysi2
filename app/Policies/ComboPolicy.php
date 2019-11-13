<?php

namespace App\Policies;

use App\User;
use App\Combo;
use Illuminate\Auth\Access\HandlesAuthorization;

class ComboPolicy
{
    use HandlesAuthorization;

    public function before($user){
        if($user->hasRole('Administrador')){
            return true;
        }
    }
    
    /**
     * Determine whether the user can view any combos.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        //
    }

    /**
     * Determine whether the user can view the combo.
     *
     * @param  \App\User  $user
     * @param  \App\Combo  $combo
     * @return mixed
     */
    public function view(User $user, Combo $combo)
    {
        return $user->hasRole('Administrador') || $user->hasPermissionTo('Ver combos');
    }

    /**
     * Determine whether the user can create combos.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        return $user->hasRole('Administrador') || $user->hasPermissionTo('Crear combos');
    }

    /**
     * Determine whether the user can update the combo.
     *
     * @param  \App\User  $user
     * @param  \App\Combo  $combo
     * @return mixed
     */
    public function update(User $user, Combo $combo)
    {
        return $user->hasRole('Administrador') || $user->hasPermissionTo('Actualizar combos');
    }

    /**
     * Determine whether the user can delete the combo.
     *
     * @param  \App\User  $user
     * @param  \App\Combo  $combo
     * @return mixed
     */
    public function delete(User $user, Combo $combo)
    {
        return $user->hasRole('Administrador') || $user->hasPermissionTo('Eliminar combos');
    }

    /**
     * Determine whether the user can restore the combo.
     *
     * @param  \App\User  $user
     * @param  \App\Combo  $combo
     * @return mixed
     */
    public function restore(User $user, Combo $combo)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the combo.
     *
     * @param  \App\User  $user
     * @param  \App\Combo  $combo
     * @return mixed
     */
    public function forceDelete(User $user, Combo $combo)
    {
        //
    }
}
