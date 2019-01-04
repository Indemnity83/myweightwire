<?php

namespace App\Http\Controllers;

use App\Matchup;

class MatchupController extends Controller
{
    /**
     * Display the specified resource.
     *
     * @param  \App\Matchup  $matchup
     * @return \Illuminate\Http\Response
     */
    public function show(Matchup $matchup)
    {
        return view('matchups.show', [
            'matchup' => $matchup,
        ]);
    }
}
