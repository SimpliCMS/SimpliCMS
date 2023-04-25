<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <!-- CSRF Token -->
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'SimpliCMS') }}</title>

        <!-- Fonts -->
        <link rel="dns-prefetch" href="https://fonts.gstatic.com">
        <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet" type="text/css">

        <!-- Styles -->
        <link href="{{ themes('css/app.css') }}" rel="stylesheet">
        @include('layouts._favicons')
    </head>
    <body>
        <div id="app">
            <nav class="navbar navbar-expand-md navbar-dark navbar-simplicms">
                <div class="container">
                    <a class="navbar-brand" href="{{ url('/') }}">
                        {{ config('app.name', 'SimpliCMS') }}
                    </a>
                    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                        <span class="navbar-toggler-icon"></span>
                    </button>

                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        <!-- Left Side Of Navbar -->
                        <ul class="navbar-nav mr-auto">
                            @include('partials.menu.main', ['menu' => Core::getMenu('Main Menu')])
                        </ul>
                        <!-- Right Side Of Navbar -->
                        @guest
                        <ul class="navbar-nav ml-auto">
                            @include('partials.menu.main', ['menu' => Core::getMenu('Guest Menu')])
                        </ul>
                        @else
                        <ul class="navbar-nav ml-auto">
                           @include('partials.menu.main', ['menu' => Core::getMenu('User Menu')])
                        </ul>
                        @endguest
                    </div>
                </div>
            </nav>

            <main class="py-4">

                <div class="container">
                    @yield('categories-menu')
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb bg-transparent">
                            @yield('breadcrumbs')
                        </ol>
                    </nav>
                    @include('flash::message')
                </div>

                @yield('content')
            </main>
        </div>

        <!-- Scripts -->
        @stack('alpine')
        <script src="{{ themes('js/app.js') }}"></script>
        @stack('scripts')
    </body>
</html>