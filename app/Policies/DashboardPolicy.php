<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class DashboardPolicy
{
    use HandlesAuthorization;

    /**
     * Create a new policy instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }


    /**
     * Determine if the user has Super User privileges (ADMIN)
     * Admin user is granted all previleges over "Cliente" entity
     *
     *
     * @param \App\Models\User $user
     * @param $ability
     * @return bool
     */
    public function before($user, $ability)
    {
        if ($user->tipo == 'A') {
            return true;
        }
    }

    public function viewAny(User $user){
        return $user->tipo == 'F';
    }
}
