<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Jobs\UpdateLossForWeighin;

class WeighinController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $weighins = $request->user()->weighins;
        $chartdata = $weighins->map(function ($weighin) {
            return [
                't' => $weighin->weighed_at->toDateString(),
                'y' => $weighin->weight,
            ];
        });

        return view('weighins.index', [
            'weighins' => $weighins,
            'chartdata' => [
                'datasets' => [
                    [
                        'backgroundColor' => '#9561e2',
                        'borderColor' => '#9561e2',
                        'fill' => false,
                        'data' => $chartdata,
                    ],
                ],
            ],
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'weight' => [
                'required',
                'numeric',
                'between:100,300',
            ],
        ]);

        $weighin = $request->user()->weighins()->updateOrCreate([
            'weighed_at' => today(),
        ], [
            'weight' => $request->get('weight'),
        ]);

        dispatch(new UpdateLossForWeighin($weighin));

        return redirect()->route('weighins.index');
    }
}
