<?php

namespace App;

use App\Notifications\AccountApproved;
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
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'is_admin' => 'bool',
        'approved_at' => 'datetime',
        'email_verified_at' => 'datetime',
    ];

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
     * The users weighins.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function weighins()
    {
        return $this->hasMany(Weighin::class);
    }

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
     * @throws \Throwable
     */
    public function setApproved()
    {
        $this->forceFill([
            'approved_at' => $this->freshTimestamp(),
        ])->saveOrFail();

        $this->notify(new AccountApproved);
    }
}
