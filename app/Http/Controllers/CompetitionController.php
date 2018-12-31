<?php

namespace App\Http\Controllers;

use App\Competition;

class CompetitionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('competitions.index', [
           'competitions' => Competition::all(),
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Competition  $competition
     * @return \Illuminate\Http\Response
     */
    public function show(Competition $competition)
    {
        $matchups = $competition
            ->matchups()
            ->with('users', 'competition')
            ->forWeek(request('week', 1))
            ->get();

        $matchups->map(function ($matchup) {
            return $matchup->users->map(function ($user) use ($matchup) {
                $initial = optional($user->weighins()->on($matchup->starts_on)->first())->weight;
                $final = optional($user->weighins()->onOrBefore($matchup->ends_on)->first())->weight;
                $user->loss = percentChange($initial, $final, 2);

                return $user;
            });
        });

        return view('competitions.show', [
            'competition' => $competition,
            'matchups' => $matchups,
        ]);
    }
}
