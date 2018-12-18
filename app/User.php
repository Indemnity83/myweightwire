<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

/**
 * @property bool is_admin
 * @property \Illuminate\Support\Carbon approved_at
 */
class User extends Authenticatable implements MustVerifyEmail
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * Limit query to admin users.
     *
     * @param Builder $query
     * @return Builder
     */
    public function scopeAdmin(Builder $query)
    {
        return $query->where('is_admin', true);
    }

    /**
     * Determine if the account has been approved.
     *
     * @return bool
     */
    public function hasApprovedAccount()
    {
        return ! is_null($this->approved_at);
    }

    /**
     * Mark the given user's account as approved.
     *
     * @return bool
     */
    public function markAccountAsApproved()
    {
        return $this->forceFill([
            'approved_at' => $this->freshTimestamp(),
        ])->save();
    }
}
