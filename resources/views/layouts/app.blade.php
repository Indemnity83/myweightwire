<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>My Weight Wire</title>

    <!-- Scripts -->
    <script src="{{ mix('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet" type="text/css">
    <link href="https://use.fontawesome.com/releases/v5.6.3/css/all.css" rel="stylesheet" integrity="sha384-UHRtZLI+pbxtHCWp1t77Bi1L4ZtiqrqD80Kn4Z8NTSRyMA2Fd33n5dQ8lWUE00s/" crossorigin="anonymous">

    <!-- Styles -->
    <link href="{{ mix('css/app.css') }}" rel="stylesheet">
</head>
<body class="font-sans antialiased text-black leading-tight bg-grey-lightest">
<div id="app">

    <navigation>
        <div class="sm:flex-grow">
            <a href="{{ route('competitions.index') }}" class="no-underline block mt-4 sm:inline-block sm:mt-0 text-grey-dark hover:text-grey-darker mr-4">
                Competitions
            </a>
            <a href="{{ route('weighins.index') }}" class="no-underline block mt-4 sm:inline-block sm:mt-0 text-grey-dark hover:text-grey-darker mr-4">
                Weigh-ins
            </a>
            <a href="javascript:;" onclick="document.getElementById('logoutForm').submit();" class="no-underline block mt-4 sm:inline-block sm:mt-0 text-grey-dark hover:text-grey-darker">
                Log Out
            </a>

        </div>
        <div>
            <form class="flex mt-4 sm:mt-0" action="{{ route('weighins.store') }}" method="post">
                @csrf
                <div class="mr-2">
                    <label class="sr-only" for="weight">
                        Weight
                    </label>
                    <input class="w-20 appearance-none border rounded py-2 px-2 text-grey-darker leading-tight focus:outline-none" id="weight" type="number" step="0.1" name="weight" value="{{ request()->user()->todaysWeight }}">
                </div>
                <button class="bg-purple-dark hover:bg-purple text-white font-bold py-2 px-4 rounded focus:outline-none" type="submit">
                    Weighin
                </button>
            </form>
        </div>
    </navigation>

    <form method="post" id="logoutForm" action="{{ route('logout') }}">
        {{ csrf_field() }}
    </form>

    <div class="mx-auto container my-8">
        @yield('body')
    </div>

    <div class="text-center text-grey text-xs mt-auto mb-3 px-3">
        <p>
            Application made by <a href="https://www.youtube.com/watch?v=DLzxrzFCyOs" class="hover:text-grey-light no-underline text-grey-dark">Kyle Klaus</a>
            •
            Icons made by <a href="https://www.flaticon.com/authors/smalllikeart" class="hover:text-grey-light no-underline text-grey-dark" title="smalllikeart">smalllikeart</a> from <a href="https://www.flaticon.com/" class="hover:text-grey-light no-underline text-grey-dark" title="Flaticon">www.flaticon.com</a> is licensed by <a href="http://creativecommons.org/licenses/by/3.0/" class="hover:text-grey-light no-underline text-grey-dark" title="Creative Commons BY 3.0" target="_blank">CC 3.0 BY</a>
        </p>
    </div>

    <script id="dsq-count-scr" src="//myweighwire.disqus.com/count.js" async></script>
</div>
</body>