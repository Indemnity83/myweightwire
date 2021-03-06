<?php

namespace App\Http\Controllers;

use App\Competition;
use Illuminate\Http\Request;

class CompetitionController extends Controller
{
    /**
     * @var array
     */
    private $colorStack = [
        '#e6194B',
        '#3cb44b',
        '#ffe119',
        '#4363d8',
        '#f58231',
        '#42d4f4',
        '#f032e6',
        '#fabebe',
        '#469990',
        '#e6beff',
        '#9A6324',
        '#fffac8',
        '#800000',
        '#aaffc3',
        '#000075',
    ];

    /**
     * Display a listing of the resource.
     *
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->user()->competitions->count() === 1) {
            return redirect()->route('competitions.show', $request->user()->competitions->first());
        }

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
            ->forWeek(request('week', $competition->currentWeek))
            ->get();

        $matchups->map(function ($matchup) {
            return $matchup->users->map(function ($user) use ($matchup) {
                $initial = optional($user->weighins()->onOrAfter($matchup->starts_on)->first())->weight;
                $final = optional($user->weighins()->onOrBefore($matchup->ends_on)->first())->weight;
                $user->loss = percentChange($initial, $final, 2);

                return $user;
            });
        });

        $datasets = $competition->users->load(['weighins' => function ($query) use ($competition) {
            $query->between($competition->starts_on, $competition->ends_on);
        }])->map(function ($user) {
            $color = $this->getNextColor();

            return [
                'label' => $user->name,
                'backgroundColor' => $color,
                'borderColor' => $color,
                'fill' => false,
                'data' => $user->weighins->map(function ($weighin) use ($user) {
                    return [
                        't' => $weighin->weighed_at->toDateString(),
//                        'y' => $weighin->loss ?? 0,
                        'y' => percentChange($user->weighins->first()->weight, $weighin->weight, 2) * -1,
                    ];
                }),
            ];
        });

        $labels = [];
        foreach (range(0, $competition->duration) as $week) {
            $label = $competition->starts_on->addWeeks($week);
            $labels[] = $label->toDateString();
            if ($label->greaterThan(today())) {
                break;
            }
        }

        $leaders = $competition->users->load(['weighins' => function ($query) use ($competition) {
            $query->between($competition->starts_on, $competition->ends_on);
        }])->map(function ($user) {
            $user->loss = percentChange($user->weighins->first()->weight, $user->weighins->last()->weight, 2) * -1;

            return $user;
        })->sortByDesc('loss')->values();

        return view('competitions.show', [
            'competition' => $competition,
            'chartdata' => [
                'labels' => $labels,
                'datasets' => $datasets,
            ],
            'matchups' => $matchups,
            'leaders' => $leaders,
        ]);
    }

    private function getNextColor()
    {
        $color = array_shift($this->colorStack);
        array_push($this->colorStack, $color);

        return $color;
    }
}
