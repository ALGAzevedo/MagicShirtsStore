<?php

namespace App\Policies;

use App\Models\Estampa;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class EstampaPolicy
{
    use HandlesAuthorization;


    /**
     * Determine whether the user can view any models.
     *
     * @param  \App\Models\User  $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        return false;
    }

    public function viewAny_Admin(User $user)
    {
        return $user->tipo == 'A';
    }



    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Estampa  $estampa
     * @return mixed
     */
    public function view(User $user, Estampa $estampa)
    {
        return false;
    }


    public function view_Admin(User $user, Estampa $estampa)
    {
        return $user->tipo == 'A' && $estampa->cliente_id == null;
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\Models\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        return false;
    }

    public function create_Admin(User $user)
    {
        return $user->tipo == 'A';
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Estampa  $estampa
     * @return mixed
     *
     */

    public function update(User $user, Estampa $estampa)
    {
        return false;
    }

    public function update_Admin(User $user, Estampa $estampa)
    {
        return $user->tipo == 'A' && $estampa->cliente_id == null;
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Estampa  $estampa
     * @return mixed
     */
    public function delete(User $user, Estampa $estampa)
    {
        return false;
    }

    public function delete_Admin(User $user, Estampa $estampa)
    {
        return $user->tipo == 'A' && $estampa->cliente_id == null;
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Estampa  $estampa
     * @return mixed
     */
    public function restore(User $user, Estampa $estampa)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Estampa  $estampa
     * @return mixed
     */
    public function forceDelete(User $user, Estampa $estampa)
    {
        //
    }
}
