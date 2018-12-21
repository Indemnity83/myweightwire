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

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body class="font-sans antialiased text-black leading-tight">
<div id="app">
    <div class="mb-16">
        @yield('body')
    </div>

    <div class="fixed w-full text-center border-t border-grey-lighter bg-white p-4 h-16 pin-b">
        <a href="/privacy" class="mx-1 text-sm text-grey hover:text-purple py-2 px-1">
            Privacy Policy
        </a>
        <a href="/terms" class="mx-1 text-sm text-grey hover:text-purple py-2 px-1">
            Terms of Service
        </a>
    </div>
</div>
<script src="{{ mix('js/app.js') }}"></script>
</body>
</html>