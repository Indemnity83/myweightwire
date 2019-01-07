@extends('layouts.app')

@section('body')
    <div class="flex flex-col lg:flex-row mb-6">
        <div class="w-full lg:w-1/3">
            <form class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4 mr-4" action="{{ route('weighins.store') }}" method="post">
                @csrf
                <div class="mb-6">
                    <label class="block text-grey-darker text-sm font-bold mb-2" for="weight">
                        Weight
                    </label>
                    <input class="shadow appearance-none border rounded w-full py-2 px-3 text-grey-darker leading-tight focus:outline-none focus:shadow-outline {{ $errors->has('weight') ? 'border-red mb-3' : '' }}" id="weight" type="number" step="0.1" name="weight" value="{{ old('weight', request()->user()->todaysWeight) }}">
                    @if ($errors->has('weight'))
                        <p class="text-red text-xs italic">{{ $errors->first('weight') }}</p>
                    @endif
                </div>
                <button class="bg-blue hover:bg-blue-dark text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline" type="submit">
                    Record Today's Weight
                </button>
            </form>
        </div>

        <div class="w-full lg:w-2/3">
            <div class="bg-white shadow-md rounded mb-4 p-4">
                {{--<personal-weight-chart></personal-weight-chart>--}}
                <line-chart
                    :chartdata='@json($chartdata)'
                    :options='{"responsive":true,"maintainAspectRatio":false,"legend":{"display":false},"scales":{"xAxes":[{"type":"time","distribution":"linear"}]}}'
                ></line-chart>
            </div>
        </div>
    </div>

    <div>
        <div class="w-full">
            <div class="bg-white shadow-md rounded">
                <table class="table">
                    <thead class="thead-light">
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Date</th>
                        <th scope="col">Weight</th>
                        <th scope="col">% Change</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($weighins as $weighin)
                    <tr>
                        <th scope="row">{{ $weighin->id }}</th>
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
