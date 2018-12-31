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

        foreach (range(1, $this->duration) as $week_number) {
            $users->chunk(2)->each(function ($competitors) use ($week_number) {
                $matchup = $this->matchups()->create(['week_number' => $week_number]);
                $matchup->users()->attach($competitors->pluck('id'));
            });

            $firstUser = $users->shift();
            $secondUser = $users->shift();
            $users = $users->prepend($firstUser)->push($secondUser);
        }
    }
}
