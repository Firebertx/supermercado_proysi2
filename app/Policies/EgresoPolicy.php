<?php

namespace App\Policies;

use App\User;
use App\Egreso;
use Illuminate\Auth\Access\HandlesAuthorization;

class EgresoPolicy
{
    use HandlesAuthorization;

    public function before($user){
        if($user->hasRole('Administrador')){
            return true;
        }
    }
    
    /**
     * Determine whether the user can view any egresos.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        //
    }

    /**
     * Determine whether the user can view the egreso.
     *
     * @param  \App\User  $user
     * @param  \App\Egreso  $egreso
     * @return mixed
     */
    public function view(User $user, Egreso $egreso)
    {
        return $user->hasRole('Administrador') || $user->hasPermissionTo('Ver egresos');
    }

    /**
     * Determine whether the user can create egresos.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        return $user->hasRole('Administrador') || $user->hasPermissionTo('Crear egresos');
    }

    /**
     * Determine whether the user can update the egreso.
     *
     * @param  \App\User  $user
     * @param  \App\Egreso  $egreso
     * @return mixed
     */
    public function update(User $user, Egreso $egreso)
    {
        return $user->hasRole('Administrador') || $user->hasPermissionTo('Actualizar egresos');
    }

    /**
     * Determine whether the user can delete the egreso.
     *
     * @param  \App\User  $user
     * @param  \App\Egreso  $egreso
     * @return mixed
     */
    public function delete(User $user, Egreso $egreso)
    {
        return $user->hasRole('Administrador') || $user->hasPermissionTo('Eliminar egresos');
    }

    /**
     * Determine whether the user can restore the egreso.
     *
     * @param  \App\User  $user
     * @param  \App\Egreso  $egreso
     * @return mixed
     */
    public function restore(User $user, Egreso $egreso)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the egreso.
     *
     * @param  \App\User  $user
     * @param  \App\Egreso  $egreso
     * @return mixed
     */
    public function forceDelete(User $user, Egreso $egreso)
    {
        //
    }
}
