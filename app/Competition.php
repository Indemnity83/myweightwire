<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @property \Carbon\Carbon starts_on
 * @property \Carbon\Carbon ends_on
 * @property int duration
 * @property \Illuminate\Database\Eloquent\Collection users
 * @property int currentWeek
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
     * The competition end date attribute.
     *
     * @return \Carbon\Carbon
     */
    public function getEndsOnAttribute()
    {
        return $this->starts_on->addWeeks($this->duration);
    }

    /**
     * The current week of the competition.
     *
     * @return int
     */
    public function getCurrentWeekAttribute()``
    {
        $week = $this->starts_on->diffInWeeks(today()->subDay()) + 1;

        return min($week, $this->duration);
    }

    /**
     * The total pounds lost during the competition.
     *
     * @return mixed
     */
    public function getTotalPoundsLostAttribute()
    {
        return round($this->users->reduce(function ($carry, $user) {
            $initial = $user->weighins()->on($this->starts_on)->first();
            $final = $user->weighins()->onOrBefore($this->ends_on)->first();

            if ($initial === null || $final === null) {
                return $carry;
            }

            return $carry += $initial->weight - $final->weight;
        }), 1);
    }

    /**
     * Generate random matchups.
     *
     * @param null $seed
     */
    public function generateRandomMatchups($seed = null)
    {
        // Shuffle the users, this is the only "random" part
        $competitors = $this->users->shuffle($seed);

        // If there are an odd number of competitors, a dummy competitor can be added,
        // whose scheduled opponent in a given round does not play and has a bye.
        if ($competitors->count() % 2 === 1) {
            $competitors->push(new User);
        }

        // Competitors are split into two groups
        /** @var \Illuminate\Support\Collection $groupA */
        /** @var \Illuminate\Support\Collection $groupB */
        [$groupA, $groupB] = $competitors->split(2);

        // For the first round, players from each group are matched up
        $groupA->zip($groupB)->each(function ($comptetitors) {
            $matchup = $this->matchups()->create(['week_number' => 1]);
            $matchup->users()->attach($comptetitors->pluck('id')->all());
        });

        // For the remaining rounds the first player is fixed, and all other
        // players rotate clockwise before being matched up again.
        foreach (range(2, $this->duration) as $week_number) {
            // Shift the first player off the list, they will remain fixed in position 1
            $fixedPlayer = $groupA->shift();

            // Rotate the remaining players clockwise by placing the last item from groupA
            // at the end of groupB
            $groupB->push($groupA->pop());

            // Then placing the first item from groupB to the beginning of groupA
            $groupA->prepend($groupB->shift());

            // Put the fixed player back at the beginning of groupA
            $groupA->prepend($fixedPlayer);

            // And finally, players from each group are matched up
            $groupA->zip($groupB)->each(function ($comptetitors) use ($week_number) {
                $matchup = $this->matchups()->create(['week_number' => $week_number]);
                $matchup->users()->attach($comptetitors->pluck('id')->all());
            });
        }
    }
}
