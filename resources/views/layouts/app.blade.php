<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>My Weight Wire</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet" type="text/css">
    <link href="https://use.fontawesome.com/releases/v5.6.3/css/all.css" rel="stylesheet" integrity="sha384-UHRtZLI+pbxtHCWp1t77Bi1L4ZtiqrqD80Kn4Z8NTSRyMA2Fd33n5dQ8lWUE00s/" crossorigin="anonymous">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body class="font-sans antialiased text-black leading-tight bg-grey-lightest">
<div id="app">

    <header class="w-full font-sans border-b-2 border-grey-lighter bg-white">
        <nav class="container mx-auto flex items-center justify-between flex-wrap py-3">
            <div class="flex items-center flex-no-shrink text-white mr-6">
                <h1 class="text-black text-2xl p-2 align-middle font-sans relative pl-8">
                    <a href="{{ route('home') }}" class="flex items-center no-underline text-purple">
                        <svg xmlns="http://www.w3.org/2000/svg" height="30" viewBox="-16 0 480 480" class="text-purple-dark mr-3 fill-current" style="transform: rotate(-12.5deg);"><path d="M448 424V56c-.035-30.914-25.086-55.965-56-56H56C25.086.035.035 25.086 0 56v368c.035 30.914 25.086 55.965 56 56h336c30.914-.035 55.965-25.086 56-56zm-432 0V56c.027-22.082 17.918-39.973 40-40h336c22.082.027 39.973 17.918 40 40v368c-.027 22.082-17.918 39.973-40 40H56c-22.082-.027-39.973-17.918-40-40zm0 0"></path><path d="M416 424V56c-.016-13.25-10.75-23.984-24-24H56c-13.25.016-23.984 10.75-24 24v368c.016 13.25 10.75 23.984 24 24h336c13.25-.016 23.984-10.75 24-24zm-360 8a8.005 8.005 0 0 1-8-8V56a8.005 8.005 0 0 1 8-8h336a8.005 8.005 0 0 1 8 8v368a8.005 8.005 0 0 1-8 8zm0 0"/><path d="M80 192h288a8 8 0 0 0 8-8V72a8 8 0 0 0-8-8H80a8 8 0 0 0-8 8v112a8 8 0 0 0 8 8zm8-112h27.055l13.789 27.578a8 8 0 0 0 10.734 3.578 8 8 0 0 0 3.578-10.734L132.946 80H216v16a8 8 0 0 0 16 0V80h83.055l-10.211 20.422a8 8 0 0 0 3.578 10.734 8 8 0 0 0 10.734-3.578L332.946 80H360v96H227.312l-53.656-53.656A8 8 0 0 0 160 128v24a8 8 0 0 0 16 0v-4.688L204.688 176H88zm0 0M224 208a8 8 0 0 0-8 8v16a8 8 0 0 0 16 0v-16a8 8 0 0 0-8-8zm0 0M224 256a8 8 0 0 0-8 8v144a8 8 0 0 0 16 0V264a8 8 0 0 0-8-8zm0 0M152.336 267.945l-16.399-2.73a31.88 31.88 0 0 0-17.14 1.851l-11.961 4.782v.004c-16.086 6.535-24.086 24.652-18.086 40.945l14.234 37.95a15.973 15.973 0 0 1 1.016 5.605V376c0 17.672 14.328 32 32 32s32-14.328 32-32v-21.367c.004-1.168.133-2.328.383-3.469l9.937-44.71a32.006 32.006 0 0 0-4.718-24.837 32.004 32.004 0 0 0-21.266-13.672zm10.36 35.04l-9.938 44.73a32.44 32.44 0 0 0-.758 6.918V376c0 8.836-7.164 16-16 16s-16-7.164-16-16v-19.648a31.803 31.803 0 0 0-2.04-11.235l-14.226-37.937c-3.004-8.145.996-17.207 9.04-20.477l11.968-4.781a15.942 15.942 0 0 1 8.57-.926l16.399 2.73a15.998 15.998 0 0 1 12.984 19.258zm0 0M98.344 242.344a7.997 7.997 0 0 0 0 11.312l8 8a7.998 7.998 0 0 0 11.304-.008 7.998 7.998 0 0 0 .008-11.304l-8-8a7.997 7.997 0 0 0-11.312 0zm0 0M128 240v8a8 8 0 0 0 16 0v-8a8 8 0 0 0-16 0zm0 0M162.344 242.344l-8 8a8.005 8.005 0 0 0-2.078 7.73 7.987 7.987 0 0 0 5.66 5.66 8.005 8.005 0 0 0 7.73-2.078l8-8a7.998 7.998 0 0 0-.008-11.304 7.998 7.998 0 0 0-11.304-.008zm0 0M93.656 277.656a7.997 7.997 0 0 0 0-11.312l-8-8a7.998 7.998 0 0 0-11.304.008 7.998 7.998 0 0 0-.008 11.304l8 8a7.997 7.997 0 0 0 11.312 0zm0 0M341.164 271.852v-.004l-11.953-4.778a31.873 31.873 0 0 0-17.149-1.855l-16.398 2.73a32.004 32.004 0 0 0-21.266 13.672 32.006 32.006 0 0 0-4.718 24.836l9.937 44.692c.25 1.144.38 2.316.383 3.488V376c0 17.672 14.328 32 32 32s32-14.328 32-32v-19.648c0-1.918.344-3.82 1.023-5.618l14.227-37.937c6-16.293-2-34.41-18.086-40.945zm3.102 35.328l-14.22 37.925A31.684 31.684 0 0 0 328 356.352V376c0 8.836-7.164 16-16 16s-16-7.164-16-16v-21.367a32.621 32.621 0 0 0-.758-6.938l-9.937-44.71a16.002 16.002 0 0 1 12.984-19.258l16.399-2.73c.87-.145 1.75-.22 2.632-.22 2.035 0 4.055.391 5.946 1.149l11.96 4.777c8.044 3.27 12.044 12.332 9.04 20.477zm0 0M338.344 242.344l-8 8a8.005 8.005 0 0 0-2.078 7.73 7.987 7.987 0 0 0 5.66 5.66 8.005 8.005 0 0 0 7.73-2.078l8-8a7.998 7.998 0 0 0-.008-11.304 7.998 7.998 0 0 0-11.304-.008zm0 0M304 240v8a8 8 0 0 0 16 0v-8a8 8 0 0 0-16 0zm0 0M274.344 242.344a7.997 7.997 0 0 0 0 11.312l8 8a7.998 7.998 0 0 0 11.304-.008 7.998 7.998 0 0 0 .008-11.304l-8-8a7.997 7.997 0 0 0-11.312 0zm0 0M362.344 258.344l-8 8a8.005 8.005 0 0 0-2.078 7.73 7.987 7.987 0 0 0 5.66 5.66 8.005 8.005 0 0 0 7.73-2.078l8-8a7.998 7.998 0 0 0-.008-11.304 7.998 7.998 0 0 0-11.304-.008zm0 0"/></svg>
                        My Weight Wire
                    </a>
                </h1>
            </div>
            <div class="block lg:hidden">
                <button class="flex items-center px-3 py-2 border rounded text-grey-dark border-grey-darker hover:text-grey hover:border-grey-dark">
                    <svg class="fill-current h-3 w-3" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><title>Menu</title><path d="M0 3h20v2H0V3zm0 6h20v2H0V9zm0 6h20v2H0v-2z"/></svg>
                </button>
            </div>
            <div class="w-full block text-right flex-grow lg:flex lg:items-center lg:w-auto">
                <div class="lg:flex-grow">
                    {{--<a href="{{ route('home') }}" class="block mt-4 lg:inline-block lg:mt-0 text-grey-dark hover:text-grey-darker no-underline mr-6">--}}
                        {{--Dashboard--}}
                    {{--</a>--}}
                    <a href="{{ route('competitions.index') }}" class="block mt-4 lg:inline-block lg:mt-0 text-grey-dark hover:text-grey-darker no-underline mr-6">
                        Competitions
                    </a>
                    <a href="{{ route('weighins.index') }}" class="block mt-4 lg:inline-block lg:mt-0 text-grey-dark hover:text-grey-darker no-underline mr-6">
                        Weigh-ins
                    </a>
                    <a href="javascript:;" onclick="document.getElementById('logoutForm').submit();" class="block mt-4 lg:inline-block lg:mt-0 text-grey-dark hover:text-grey-darker no-underline mr-6">
                        Log Out
                    </a>
                </div>
                {{--<form method="post" action="{{ route('logout') }}">--}}
                {{--{{ csrf_field() }}--}}
                {{--<button type="submit" class="inline-block px-4 py-2 leading-none border rounded text-grey-dark border-grey-dark no-underline hover:border-grey hover:text-grey-darker hover:bg-white mt-4 lg:mt-0">--}}
                {{--Log Out--}}
                {{--</button>--}}
                {{--</form>--}}
            </div>
        </nav>

        <form method="post" id="logoutForm" action="{{ route('logout') }}">
            {{ csrf_field() }}
        </form>
    </header>


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

</div>
</body>