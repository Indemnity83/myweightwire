<?php

namespace App\Http\Controllers;

use App\Matchup;

class MatchupController extends Controller
{
    /**`
     * Display the specified resource.
     *
     * @param  \App\Matchup  $matchup
     * @return \Illuminate\Http\Response
     */
    public function show(Matchup $matchup)
    {
        $matchup->users->map(function ($user) use ($matchup) {
            $initial = optional($user->weighins()->on($matchup->starts_on)->first())->weight;
            $final = optional($user->weighins()->onOrBefore($matchup->ends_on)->first())->weight;
            $user->loss = percentChange($initial, $final, 2);

            return $user;
        });

        return view('matchups.show', [
            'matchup' => $matchup,
        ]);
    }
}
