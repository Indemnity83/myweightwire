@extends('layouts.app')

@section('body')
    <div class="w-full mb-6">

        <ul class="flex justify-between px-8 list-reset w-auto">
            @foreach(range(1, $competition->duration) as $week)
                @if(request()->query('week', 1) == $week)
                    <li><span class="block lg:text-xl bg-purple-dark mb-8 text-purple-lightest no-underline px-3 py-2">Week {{ $week }}</span></li>
                @else
                    <li><a class="block lg:text-xl mb-8 hover:text-purple-light text-purple-dark no-underline px-3 py-2" href="{{ route('competitions.show', ['competition' => $competition, 'week' => $week]) }}">Week {{ $week }}</a></li>
                @endif
            @endforeach
        </ul>

        <div class="flex flex-col lg:flex-row justify-between">
            <div class="w-full lg:w-2/5 bg-white shadow-md rounded mb-6 mr-6">
                <span class="block p-4 w-full text-center text-2xl text-purple-dark">
                    Week {{ request()->query('week', 1) }} Matchups
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

            <div class="w-full lg:w-3/5 bg-white shadow-md rounded flex flex-col mb-6 items-center">
                <span class="block p-4 w-full text-center text-2xl text-purple-dark">
                    Percent Loss Over Time
                </span>
                <line-chart class="w-full"
                    :chartdata='@json($chartdata)'
                    :options='{"tooltips": {"callbacks":{"label": (item) => item.yLabel + "%"}}, "responsive":true,"maintainAspectRatio":false,"legend":{"position":"bottom", "labels": {"boxWidth": 12, "padding": 12}},"scales":{"yAxes":[{"ticks": {"callback": (value) => value + "%"}}], "xAxes":[{"type":"time","distribution":"linear","time":{"unit":"week"},"ticks":{"source":"labels"}}]}}'
                ></line-chart>
            </div>
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
