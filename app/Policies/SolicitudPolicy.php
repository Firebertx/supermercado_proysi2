<?php

namespace App\Policies;

use App\User;
use App\Solicitud;
use Illuminate\Auth\Access\HandlesAuthorization;

class SolicitudPolicy
{
    use HandlesAuthorization;

    public function before($user){
        if($user->hasRole('Administrador')){
            return true;
        }
    }
    /**
     * Determine whether the user can view any solicituds.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        //
    }

    /**
     * Determine whether the user can view the solicitud.
     *
     * @param  \App\User  $user
     * @param  \App\Solicitud  $solicitud
     * @return mixed
     */
    public function view(User $user, Solicitud $solicitud)
    {
        return $user->hasRole('Administrador') || $user->hasPermissionTo('Ver solicitudes');
    }

    /**
     * Determine whether the user can create solicituds.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        return $user->hasRole('Administrador') || $user->hasPermissionTo('Crear solicitudes');
    }

    /**
     * Determine whether the user can update the solicitud.
     *
     * @param  \App\User  $user
     * @param  \App\Solicitud  $solicitud
     * @return mixed
     */
    public function update(User $user, Solicitud $solicitud)
    {
        return $user->hasRole('Administrador') || $user->hasPermissionTo('Actualizar solicitudes');
    }

    /**
     * Determine whether the user can delete the solicitud.
     *
     * @param  \App\User  $user
     * @param  \App\Solicitud  $solicitud
     * @return mixed
     */
    public function delete(User $user, Solicitud $solicitud)
    {
        return $user->hasRole('Administrador') || $user->hasPermissionTo('Eliminar solicitudes');
    }

    /**
     * Determine whether the user can restore the solicitud.
     *
     * @param  \App\User  $user
     * @param  \App\Solicitud  $solicitud
     * @return mixed
     */
    public function restore(User $user, Solicitud $solicitud)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the solicitud.
     *
     * @param  \App\User  $user
     * @param  \App\Solicitud  $solicitud
     * @return mixed
     */
    public function forceDelete(User $user, Solicitud $solicitud)
    {
        //
    }
}
