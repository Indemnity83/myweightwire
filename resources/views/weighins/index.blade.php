@extends('layouts.app')

@section('body')

    @if ($errors->has(null))
        <div class="bg-orange-lightest border-l-4 border-orange text-orange-dark p-4 mb-4" role="alert">
            <p class="font-bold">Chickity-check yo self</p>
            @foreach ($errors->all() as $error)
                <p>{{ $error }}</p>
            @endforeach
        </div>
    @endif

    <ul class="list-reset flex flex-col md:flex-row items-center">
        <li class="flex-1 w-full md:mr-4 mb-4">
            <div class="no-underline rounded text-center block text-purple bg-white shadow py-2 px-1">
                <div class="px-6 py-4 text-left">
                    <div class="text-grey-dark text-xl mb-2">Record Weigh-in</div>
                    <form class="flex mt-4 sm:mt-0" action="{{ route('weighins.store') }}" method="post">
                        @csrf
                        <div class="mr-2">
                            <label class="sr-only" for="weight">
                                Weight
                            </label>
                            <input class="w-20 appearance-none border rounded py-2 px-2 text-grey-darker leading-tight focus:outline-none" id="weight" type="number" step="0.1" name="weight" value="{{ request()->user()->todaysWeight }}">
                        </div>
                        <button class="bg-purple-light hover:bg-purple-lighter text-white font-bold py-2 px-4 rounded focus:outline-none" type="submit">
                            Weighin
                        </button>
                    </form>
                </div>
            </div>
        </li>

        <li class="flex-1 w-full md:mr-4 mb-4">
            <div class="no-underline rounded text-center block text-purple bg-white shadow py-2 px-1">
                <div class="px-6 py-4 text-left">
                    <div class="text-grey-dark text-xl mb-2">Total Weight Loss</div>
                    <p class="text-purple-dark text-2xl">
                        {{ request()->user()->totalPoundsLost }} lbs
                    </p>
                </div>
            </div>
        </li>

        <li class="flex-1 w-full mb-4">
            <div class="no-underline rounded text-center block text-purple bg-white shadow py-2 px-1">
                <div class="px-6 py-4 text-left">
                    <div class="text-grey-dark text-xl mb-2">Total Percent Change</div>
                    <p class="text-purple-dark text-2xl">
                        {{ request()->user()->totalPercentLost }} %
                    </p>
                </div>
            </div>
        </li>
    </ul>

    <div class="w-full mb-4">
        <div class="bg-white shadow-md rounded p-4">
            <line-chart
                :chartdata='@json($chartdata)'
                :options='{"responsive":true,"maintainAspectRatio":false,"legend":{"display":false},"scales":{"xAxes":[{"type":"time","distribution":"linear"}]}}'
            ></line-chart>
        </div>
    </div>

    <div>
        <div class="w-full">
            <div class="bg-white shadow-md rounded">
                <table class="table">
                    <thead class="thead-light">
                    <tr>
                        <th scope="col" class="hidden md:table-cell">#</th>
                        <th scope="col">Date</th>
                        <th scope="col">Weight</th>
                        <th scope="col">% Change</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($weighins as $weighin)
                    <tr>
                        <th scope="row" class="hidden md:table-cell">{{ $weighin->id }}</th>
                        <td>{{ $weighin->weighed_at->diff(now())->days < 1 ? 'today' : $weighin->weighed_at->diffForHumans(now(), true) . ' ago' }}</td>
                        <td>{{ $weighin->weight }} lbs</td>
                        @if($weighin->loss === null)
                            <td class="text-grey">&mdash;</td>
                        @elseif($weighin->loss >= 0)
                            <td class="text-red-dark">{{ $weighin->loss }}%</td>
                        @else()
                            <td class="text-green-dark">{{ $weighin->loss }}%</td>
                        @endif
                    </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
