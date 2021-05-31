<?php

namespace App\Policies;

use App\Models\Encomenda;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class EncomendaPolicy
{
    use HandlesAuthorization;

    public function before(User $user) {
        if($user->tipo == 'A') {
            return true;
        }
    }


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

    public function viewEstado(User $user, $view) {

        if($user->tipo == 'A')
        {
            return true;
        }
        //funcionarios apenas podem ver encomendas pendentes e pagas
        if($user->tipo == 'F' && ($view == 'anulada' || $view =='fechada' || $view =='Mostrar tudo')) {
            return false;
        }
        else {
            return true;
        }
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Encomenda  $encomenda
     * @return mixed
     */
    public function view(User $user, Encomenda $encomenda)
    {
        return $encomenda->estado=='paga' || $encomenda->estado=='pendente';
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\Models\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        //
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Encomenda  $encomenda
     * @return mixed
     */
    public function update(User $user, Encomenda $encomenda)
    {
        return $encomenda->estado=='paga' || $encomenda->estado=='pendente';
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Encomenda  $encomenda
     * @return mixed
     */
    public function delete(User $user, Encomenda $encomenda)
    {
        //
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Encomenda  $encomenda
     * @return mixed
     */
    public function restore(User $user, Encomenda $encomenda)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Encomenda  $encomenda
     * @return mixed
     */
    public function forceDelete(User $user, Encomenda $encomenda)
    {
        //
    }
}
