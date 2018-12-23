<?php

namespace App\Http\Controllers;

use App\Weighin;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

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
        $attributes = $this->validate($request, [
            'weighed_at' => [
                'required',
                'date',
                'before_or_equal:'.today()->addSeconds(86399)->toDateString(),
                Rule::unique('weighins')->where('user_id', $request->user()->id),
            ],
            'weight' => [
                'required',
                'numeric',
                'between:100,300',
            ],
        ]);

        $request->user()->weighins()->create($attributes);

        return redirect()->route('weighins.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Weighin $weighin
     * @return \Illuminate\Http\Response
     * @throws \Exception
     */
    public function destroy(Weighin $weighin)
    {
        $this->authorize('delete', $weighin);

        $weighin->delete();

        return redirect()->route('weighins.index');
    }
}
