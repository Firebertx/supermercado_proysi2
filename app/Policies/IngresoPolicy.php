<?php

namespace App\Policies;

use App\User;
use App\Ingreso;
use Illuminate\Auth\Access\HandlesAuthorization;

class IngresoPolicy
{
    use HandlesAuthorization;

    public function before($user){
        if($user->hasRole('Administrador')){
            return true;
        }
    }
    /**
     * Determine whether the user can view any ingresos.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        //
    }

    /**
     * Determine whether the user can view the ingreso.
     *
     * @param  \App\User  $user
     * @param  \App\Ingreso  $ingreso
     * @return mixed
     */
    public function view(User $user, Ingreso $ingreso)
    {
        return $user->hasRole('Administrador') || $user->hasPermissionTo('Ver ingresos');
    }

    /**
     * Determine whether the user can create ingresos.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        return $user->hasRole('Administrador') || $user->hasPermissionTo('Crear ingresos');
    }

    /**
     * Determine whether the user can update the ingreso.
     *
     * @param  \App\User  $user
     * @param  \App\Ingreso  $ingreso
     * @return mixed
     */
    public function update(User $user, Ingreso $ingreso)
    {
        return $user->hasRole('Administrador') || $user->hasPermissionTo('Actualizar ingresos');
    }

    /**
     * Determine whether the user can delete the ingreso.
     *
     * @param  \App\User  $user
     * @param  \App\Ingreso  $ingreso
     * @return mixed
     */
    public function delete(User $user, Ingreso $ingreso)
    {
        return $user->hasRole('Administrador') || $user->hasPermissionTo('Eliminar ingresos');
    }

    /**
     * Determine whether the user can restore the ingreso.
     *
     * @param  \App\User  $user
     * @param  \App\Ingreso  $ingreso
     * @return mixed
     */
    public function restore(User $user, Ingreso $ingreso)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the ingreso.
     *
     * @param  \App\User  $user
     * @param  \App\Ingreso  $ingreso
     * @return mixed
     */
    public function forceDelete(User $user, Ingreso $ingreso)
    {
        //
    }
}
