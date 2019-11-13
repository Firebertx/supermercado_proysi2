<?php

namespace App\Policies;

use App\User;
use App\Package;
use Illuminate\Auth\Access\HandlesAuthorization;

class PackagePolicy
{
    use HandlesAuthorization;

    public function before($user){
        if($user->hasRole('Administrador')){
            return true;
        }
    }
    /**
     * Determine whether the user can view any packages.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        //
    }

    /**
     * Determine whether the user can view the package.
     *
     * @param  \App\User  $user
     * @param  \App\Package  $package
     * @return mixed
     */
    public function view(User $user, Package $package)
    {
        return $user->hasRole('Administrador') || $user->hasPermissionTo('Ver paquetes');
    }

    /**
     * Determine whether the user can create packages.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        return $user->hasRole('Administrador') || $user->hasPermissionTo('Crear paquetes');
    }

    /**
     * Determine whether the user can update the package.
     *
     * @param  \App\User  $user
     * @param  \App\Package  $package
     * @return mixed
     */
    public function update(User $user, Package $package)
    {
        return $user->hasRole('Administrador') || $user->hasPermissionTo('Actualizar paquetes');
    }

    /**
     * Determine whether the user can delete the package.
     *
     * @param  \App\User  $user
     * @param  \App\Package  $package
     * @return mixed
     */
    public function delete(User $user, Package $package)
    {
        return $user->hasRole('Administrador') || $user->hasPermissionTo('Eliminar paquetes');
    }

    /**
     * Determine whether the user can restore the package.
     *
     * @param  \App\User  $user
     * @param  \App\Package  $package
     * @return mixed
     */
    public function restore(User $user, Package $package)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the package.
     *
     * @param  \App\User  $user
     * @param  \App\Package  $package
     * @return mixed
     */
    public function forceDelete(User $user, Package $package)
    {
        //
    }
}
