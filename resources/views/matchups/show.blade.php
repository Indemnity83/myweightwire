@extends('layouts.app')

@section('body')
    <a href="{{ route('competitions.show', $matchup->competition_id) }}">&larr; Back to competition</a>

    <h2 class="text-purple-dark text-center mb-6">Week {{ $matchup->week_number }} Match-up</h2>

    <div class="flex justify-between mb-6">
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

    <div class="w-full ">
        <div id="disqus_thread"></div>
        <script>
            var disqus_config = function () {
                this.page.url = '{{ request()->url() }}';
                this.page.identifier = '{{ md5("matchup.{$matchup->id}") }}';
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
