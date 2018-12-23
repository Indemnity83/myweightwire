<?php

namespace App\Policies;

use App\User;
use App\Weighin;
use Illuminate\Auth\Access\HandlesAuthorization;

class WeighinPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can delete the weighin.
     *
     * @param  \App\User  $user
     * @param  \App\Weighin  $weighin
     * @return mixed
     */
    public function delete(User $user, Weighin $weighin)
    {
        return $weighin->user->is($user);
    }
}
