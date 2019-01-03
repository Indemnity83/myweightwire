<?php

namespace App\Policies;

use App\User;
use App\Weighin;
use Illuminate\Auth\Access\HandlesAuthorization;

class WeighinPolicy
{
    use HandlesAuthorization;

    /**
     * Check if policy can be bypassed.
     *
     * @param \App\User $user
     * @param string $ability
     * @return mixed
     */
    public function before($user, $ability)
    {
        if ($user->is_admin) {
            return true;
        }
    }

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

    /**
     * Determine whether the user can update the weighin.
     *
     * @param  \App\User  $user
     * @param  \App\Weighin  $weighin
     * @return mixed
     */
    public function update(User $user, Weighin $weighin)
    {
        return $weighin->user->is($user);
    }
}
