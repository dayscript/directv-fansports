<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'DirecTV Fansports') }}</title>
    <!-- Styles -->
    <link href="{{ mix('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/pnotify.css') }}" rel="stylesheet">
</head>
<body>
    @include('layouts.partials.googleanalytics')
    <div class="reveal" id="loadingModal" data-reveal data-close-on-esc="false" data-overlay="true" data-close-on-click="false">
        <img border="0" src="{{ asset('img/icons/loading-bgb.gif') }}" alt="Cargando">
    </div>
    <div id="app">
        @include('layouts.partials.header')
        @yield('content')
        @include('layouts.partials.footer')
    </div>

    <!-- Scripts -->
    <script src="{{ asset('js/jquery.min.js') }}"></script>
    <script src="{{ asset('js/foundation.min.js') }}"></script>
    <script src="{{ asset('js/pnotify.js') }}"></script>
    <script> $(document).foundation();</script>
    <script src="{{ mix('js/app.js') }}"></script>
    <script> $(document).foundation();</script>
</body>
</html>
