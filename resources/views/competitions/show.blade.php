@extends('layouts.app')

@section('body')
    <ul class="list-reset flex flex-col md:flex-row items-center">
        <li class="flex-1 w-full md:mr-4 mb-4">
            <div class="no-underline rounded text-center block text-purple bg-white shadow py-2 px-1">
                <div class="px-6 py-4 text-left">
                    <div class="text-grey-dark text-xl mb-2">Total Weight Loss</div>
                    <p class="text-purple-dark text-2xl">
                        {{ $competition->totalPoundsLost }} lbs
                    </p>
                </div>
            </div>
        </li>

        <li class="flex-1 w-full hidden md:inline md:mr-4 mb-4">
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

    <div class="flex flex-col lg:flex-row items-top">
        <div class="w-full lg:w-2/5 bg-white shadow-md rounded lg:mr-4 mb-4">
            <div class="text-grey-dark text-xl my-4 mx-6">Week {{ request()->query('week', $competition->currentWeek) }} Matchups</div>
            <div class="flex flex-col">
                @foreach($matchups as $matchup)
                <a href="{{ route('matchups.show', $matchup) }}" class="flex w-full justify-center items-center no-underline text-grey-darkest hover:bg-grey-lightest border-t border-b border-white hover:border-purple-dark py-4">
                    @if($matchup->users->count() >= 2)
                        <div class="flex items-center">
                            <div class="flex flex-col text-right">
                                <span>{{ $matchup->users->first()->name }}</span>
                                @if($matchup->users->first()->loss > 0)
                                    <span class="text-red-dark">Gained {{ abs($matchup->users->first()->loss) }}%</span>
                                @else
                                    <span class="text-green-dark">Lost {{ abs($matchup->users->first()->loss) }}%</span>
                                @endif
                            </div>
                            <img class="ml-4" src="//gravatar.com/avatar/{{ md5($matchup->users->first()->email) }}?s=60">
                        </div>
                        <div class="px-4 text-grey-light">VS</div>
                        <div class="flex items-center">
                            <img class="mr-4" src="//gravatar.com/avatar/{{ md5($matchup->users->last()->email) }}?s=60">
                            <div class="flex flex-col">
                                <span>{{ $matchup->users->last()->name }}</span>
                                @if($matchup->users->last()->loss > 0)
                                    <span class="text-red-dark">Gained {{ abs($matchup->users->last()->loss) }}%</span>
                                @else
                                    <span class="text-green-dark">Lost {{ abs($matchup->users->last()->loss) }}%</span>
                                @endif
                            </div>
                        </div>
                    @else
                        <div class="flex flex-col items-center">
                            <span class="text-grey mb-2">Bye Week</span>
                            <div class="flex items-center">
                                <img class="mr-1" src="//gravatar.com/avatar/{{ md5($matchup->users->last()->email) }}?s=25">
                                <span>{{ $matchup->users->last()->name }}</span>
                            </div>
                            @if($matchup->users->last()->loss > 0)
                                <span class="text-red-dark">Gained {{ abs($matchup->users->last()->loss) }}%</span>
                            @else
                                <span class="text-green-dark">Lost {{ abs($matchup->users->last()->loss) }}%</span>
                            @endif
                        </div>
                    @endif
                </a>
                @endforeach
            </div>
        </div>
        <div class="flex-1 w-full bg-white shadow-md rounded mb-4 px-6 py-4 ">
            <div class="text-grey-dark text-xl mb-4">Percent Loss Over Time</div>
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
