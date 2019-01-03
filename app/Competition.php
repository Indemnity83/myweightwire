<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @property \Carbon\Carbon starts_on
 * @property int duration
 * @property \Illuminate\Database\Eloquent\Collection users
 */
class Competition extends Model
{
    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'starts_on' => 'date',
    ];

    /**
     * The "booting" method of the model.
     *
     * @return void
     */
    protected static function boot()
    {
        parent::boot();

        static::deleting(function (self $competition) {
            $competition->matchups->each->delete();
            $competition->users()->detach();
        });
    }

    /**
     * Competing users.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function users()
    {
        return $this->belongsToMany(User::class, 'competitors');
    }

    /**
     * Competition matchups.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function matchups()
    {
        return $this->hasMany(Matchup::class);
    }

    /**
     * Generate random matchups.
     *
     * @param null $seed
     */
    public function generateRandomMatchups($seed = null)
    {
        $users = $this->users->shuffle($seed);
        $rounds = roundRobin($users, optional());

        $rounds->take($this->duration)->each(function ($round, $key) {
            $round->each(function ($comptetitors) use ($key) {
                $matchup = $this->matchups()->create(['week_number' => $key + 1]);
                $matchup->users()->attach($comptetitors->pluck('id')->all());
            });
        });
    }
}
