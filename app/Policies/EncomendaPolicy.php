<?php

namespace App\Policies;

use App\Models\Encomenda;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class EncomendaPolicy
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

    public function viewBackEncomenda(User $user) {
        return $user->tipo == 'F' || $user->tipo == 'A';
    }

    public function viewClientEncomenda(User $user, Encomenda $encomenda) {
        return $user->tipo == 'C' && $user->id == $encomenda->cliente_id;
    }

    public function viewAllEstados(User $user)
    {
        return $user->tipo == 'A';
    }

    public function viewEstado(User $user, $estado)
    {
        if($user->tipo == 'A') {
            return true;
        }
        if ($estado == 'anulada' || $estado == 'fechada') {
            return false;
        } else {
            return true;
        }
    }

    public function updateAnular(User $user)
    {
        return $user->tipo == 'A';
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param \App\Models\User $user
     * @param \App\Models\Encomenda $encomenda
     * @return mixed
     */
    public function view(User $user, Encomenda $encomenda)
    {
        return ($user->tipo == 'F' && ($encomenda->estado == 'paga' || $encomenda->estado == 'pendente')) || $user->tipo == 'A';
    }

    public function checkout(User $user)
    {
        return $user->tipo == 'C';
    }
    /**
     * Determine whether the user can create models.
     *
     * @param \App\Models\User $user
     * @return mixed
     */
    public function create(User $user)
    {
        //
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param \App\Models\User $user
     * @param \App\Models\Encomenda $encomenda
     * @return mixed
     */
    public function update(User $user, Encomenda $encomenda)
    {
        return ($user->tipo == 'F' && ($encomenda->estado == 'paga' || $encomenda->estado == 'pendente')) || $user->tipo == 'A';
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param \App\Models\User $user
     * @param \App\Models\Encomenda $encomenda
     * @return mixed
     */
    public function delete(User $user, Encomenda $encomenda)
    {
        //
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param \App\Models\User $user
     * @param \App\Models\Encomenda $encomenda
     * @return mixed
     */
    public function restore(User $user, Encomenda $encomenda)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param \App\Models\User $user
     * @param \App\Models\Encomenda $encomenda
     * @return mixed
     */
    public function forceDelete(User $user, Encomenda $encomenda)
    {
        //
    }

    /**
     * Verifica se o user pode ver a fatura da encomenda
     *
     * @param \App\Models\User $user
     * @param \App\Models\Encomenda $encomenda
     * @return mixed
     */
    public function viewFatura(User $user, Encomenda $encomenda)
    {
        return $user->id == $encomenda->cliente_id || $user->tipo == 'A';
    }
}
