@extends('layouts.app')

@section('body')
    <div class="w-full">

        <ul class="flex justify-between px-8 list-reset w-auto">
            @foreach(range(1, $competition->duration) as $week)
                @if(request()->query('week', 1) == $week)
                    <li><span class="block text-xl bg-purple-dark mb-8 text-purple-lightest no-underline px-3 py-2">Week {{ $week }}</span></li>
                @else
                    <li><a class="block text-xl mb-8 hover:text-purple-light text-purple-dark no-underline px-3 py-2" href="{{ route('competitions.show', ['competition' => $competition, 'week' => $week]) }}">Week {{ $week }}</a></li>
                @endif
            @endforeach
        </ul>

        <div class="flex justify-between">
            <div class="w-2/5 bg-white shadow-md rounded mr-6">
                <span class="block p-4 w-full text-center text-2xl text-purple-dark">
                    Week {{ request()->query('week', 1) }} Matchups
                </span>
                @foreach($matchups as $matchup)
                <div class="flex content-center justify-center mb-4">
                    @foreach($matchup->users as $user)
                        <div class="flex matchup m-4 w-2/5">
                            <img class="mx-4" src="//gravatar.com/avatar/{{ md5($user->email) }}?s=50">
                            <div class="flex flex-col">
                                <span>{{ $user->name }}</span>
                                @if($user->loss > 0)
                                    <span class="text-red-dark">Gained {{ abs($user->loss) }}%</span>
                                @else
                                    <span class="text-green-dark">Lost {{ abs($user->loss) }}%</span>
                                @endif
                            </div>
                        </div>
                        @endforeach
                </div>
                @endforeach
            </div>

            <div class="w-3/5 bg-white shadow-md rounded flex flex-col items-center">
                <span class="block p-4 w-full text-center text-2xl text-purple-dark">
                    Percent Loss Over Time
                </span>
                <line-chart class="w-full"
                    :chartdata='@json($chartdata)'
                    :options='{"tooltips": {"callbacks":{"label": (item) => item.yLabel + "%"}}, "responsive":true,"maintainAspectRatio":false,"legend":{"position":"bottom", "labels": {"boxWidth": 12, "padding": 12}},"scales":{"yAxes":[{"ticks": {"callback": (value) => value + "%"}}], "xAxes":[{"type":"time","distribution":"linear"}]}}'
                ></line-chart>
            </div>
        </div>
    </div>
@endsection
