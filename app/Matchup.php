<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

/**
 * @property int week_number
 * @property int first_user_id
 * @property int second_user_id
 */
class Matchup extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'week_number',
    ];

    /**
     * The relations to eager load on every query.
     *
     * @var array
     */
    protected $with = [
        'users',
    ];

    /**
     * The "booting" method of the model.
     *
     * @return void
     */
    protected static function boot()
    {
        parent::boot();

        static::deleting(function ($matchup) {
            $matchup->users()->detach();
        });
    }

    /**
     * The competition.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function competition()
    {
        return $this->belongsTo(Competition::class);
    }

    /**
     * The matched up users.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function users()
    {
        return $this->belongsToMany(User::class, 'user_matchups');
    }

    /**
     * Limit results to single week.
     *
     * @param Builder $query
     * @param $week
     * @return Builder
     */
    public function scopeForWeek(Builder $query, $week)
    {
        return $query->where('week_number', $week);
    }
}
