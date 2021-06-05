<?php

namespace App\Policies;

use App\Models\Cliente;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use Barryvdh\Debugbar\Facade as debugbar;


class ClientePolicy
{
    use HandlesAuthorization;


    /**
     * Determine whether the user can view any models.
     *
     * @param \App\Models\User $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        return $user->tipo == 'A';
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param \App\Models\User $user
     * @param \App\Models\Cliente $cliente
     * @return mixed
     */
    public function view(User $user, Cliente $cliente)
    {
        debugbar::info($cliente);
        debugbar::info($user);
        return $user->id == $cliente->id;
    }

    /**
     * Determine whether the user can create models.
     *
     * @param \App\Models\User $user
     * @return mixed
     */
    public function create(User $user)
    {
        return $user->tipo == 'C';
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param \App\Models\User $user
     * @param \App\Models\Cliente $cliente
     * @return mixed
     */
    public function update(User $user, Cliente $cliente)
    {
        return $user->id == $cliente->id;
    }

    /**
     * FOR PASSWORD
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\User  $model
     * @return mixed
     */
    public function updatePassword(User $user, Cliente $cliente)
    {
        debugbar::info($user);
        debugbar::info($cliente);
        return $user->id == $cliente->id;
    }


    /**
     * Determine only cliente can update password
     *
     * @param \App\Models\User $user
     * @param \App\Models\Cliente $cliente
     * @return mixed
     */

    public function updateBlock(User $user)
    {
        return $user->tipo == 'A';
    }


    /**
     * Determine whether the user can delete the model.
     *
     * @param \App\Models\User $user
     * @param \App\Models\Cliente $cliente
     * @return mixed
     */
    public function delete(User $user, Cliente $cliente)
    {
        return false;
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param \App\Models\User $user
     * @param \App\Models\Cliente $cliente
     * @return mixed
     */
    public function restore(User $user, Cliente $cliente)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param \App\Models\User $user
     * @param \App\Models\Cliente $cliente
     * @return mixed
     */
    public function forceDelete(User $user, Cliente $cliente)
    {
        //
    }
}
