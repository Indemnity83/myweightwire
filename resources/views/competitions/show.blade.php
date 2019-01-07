@extends('layouts.app')

@section('body')
    <ul class="list-reset flex mb-4 items-center">
        <li class="flex-1 max-w-xs mr-4">
            <div class="no-underline rounded text-center block text-purple bg-white shadow py-2 px-1">
                <div class="px-6 py-4 text-left">
                    <div class="text-grey-dark text-xl mb-2">Total Weight Loss</div>
                    <p class="text-purple-dark text-2xl">
                        {{ $competition->totalPoundsLost }} lbs
                    </p>
                </div>
            </div>
        </li>

        <li>
            <p class="text-grey">Send Kyle metric suggestions ...</p>
        </li>
    </ul>

    <ul class="list-reset flex mb-4">
        @foreach(range(1, $competition->duration) as $week)
            @if(request()->query('week', $competition->currentWeek) == $week)
                <li class="flex-1 {{ $week !== $competition->duration ? 'mr-4' : '' }}">
                    <span class="no-underline rounded text-center block text-purple border-2 border-purple bg-white shadow-md py-2 px-1">
                        W<span class="hidden sm:inline">eek</span> {{ $week }}
                    </span>
                </li>
            @else
                <li class="flex-1 {{ $week !== $competition->duration ? 'mr-4' : '' }}">
                    <a class="no-underline rounded text-center block text-purple shadow border-2 border-purple-lighter hover:border-purple bg-white hover:shadow-md  py-2 px-1" href="{{ route('competitions.show', ['competition' => $competition, 'week' => $week]) }}">
                        W<span class="hidden sm:inline">eek</span> {{ $week }}
                    </a>
                </li>
            @endif
        @endforeach
    </ul>

    <div class="flex flex-col lg:flex-row justify-between">
        <div class="w-full lg:w-2/5 bg-white shadow-md rounded mb-4 mr-6">
            <span class="block p-4 w-full text-center text-2xl text-purple-dark">
                Week {{ request()->query('week', $competition->currentWeek) }} Matchups
            </span>
            @foreach($matchups as $matchup)
            <a href="{{ route('matchups.show', $matchup) }}" class="flex content-center justify-center mb-4 no-underline text-grey-darkest hover:bg-purple-lightest">
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
            </a>
            @endforeach
        </div>

        <div class="w-full lg:w-3/5 bg-white shadow-md rounded flex flex-col mb-4 items-center">
            <span class="block p-4 w-full text-center text-2xl text-purple-dark">
                Percent Loss Over Time
            </span>
            <line-chart class="w-full"
                :chartdata='@json($chartdata)'
                :options='{"tooltips": {"callbacks":{"label": (item) => item.yLabel + "%"}}, "responsive":true,"maintainAspectRatio":false,"legend":{"position":"bottom", "labels": {"boxWidth": 12, "padding": 12}},"scales":{"yAxes":[{"ticks": {"callback": (value) => value + "%"}}], "xAxes":[{"type":"time","distribution":"linear","time":{"unit":"week"},"ticks":{"source":"labels"}}]}}'
            ></line-chart>
        </div>
    </div>

    <div class="w-full ">
        <div id="disqus_thread"></div>
        <script>
            var disqus_config = function () {
                this.page.url = '{{ request()->url() }}';
                this.page.identifier = '{{ md5("competition.{$competition->id}") }}';
            };

            (function() {
                var d = document, s = d.createElement('script');
                s.src = 'https://myweighwire.disqus.com/embed.js';
                s.setAttribute('data-timestamp', +new Date());
                (d.head || d.body).appendChild(s);
            })();
        </script>
        <noscript>Please enable JavaScript to view the <a href="https://disqus.com/?ref_noscript">comments powered by Disqus.</a></noscript>
    </div>
@endsection
