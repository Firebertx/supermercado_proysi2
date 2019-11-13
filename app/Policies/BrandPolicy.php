<?php

namespace App\Policies;

use App\User;
use App\Brand;
use Illuminate\Auth\Access\HandlesAuthorization;

class BrandPolicy
{
    use HandlesAuthorization;

    public function before($user){
        if($user->hasRole('Administrador')){
            return true;
        }
    }
    /**
     * Determine whether the user can view any brands.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        //
    }

    /**
     * Determine whether the user can view the brand.
     *
     * @param  \App\User  $user
     * @param  \App\Brand  $brand
     * @return mixed
     */
    public function view(User $user, Brand $brand)
    {
        return $user->hasRole('Administrador') || $user->hasPermissionTo('Ver marcas');
    }

    /**
     * Determine whether the user can create brands.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        return $user->hasRole('Administrador') || $user->hasPermissionTo('Crear marcas');
    }

    /**
     * Determine whether the user can update the brand.
     *
     * @param  \App\User  $user
     * @param  \App\Brand  $brand
     * @return mixed
     */
    public function update(User $user, Brand $brand)
    {
        return $user->hasRole('Administrador') || $user->hasPermissionTo('Actualizar marcas');
    }

    /**
     * Determine whether the user can delete the brand.
     *
     * @param  \App\User  $user
     * @param  \App\Brand  $brand
     * @return mixed
     */
    public function delete(User $user, Brand $brand)
    {
        return $user->hasRole('Administrador') || $user->hasPermissionTo('Eliminar marcas');
    }

    /**
     * Determine whether the user can restore the brand.
     *
     * @param  \App\User  $user
     * @param  \App\Brand  $brand
     * @return mixed
     */
    public function restore(User $user, Brand $brand)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the brand.
     *
     * @param  \App\User  $user
     * @param  \App\Brand  $brand
     * @return mixed
     */
    public function forceDelete(User $user, Brand $brand)
    {
        //
    }
}
