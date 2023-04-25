<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <!-- CSRF Token -->
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'SimpliCMS') }}</title>
        @include('layouts._favicons')
        <!-- Fonts -->
        <link rel="dns-prefetch" href="https://fonts.gstatic.com">
        <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet" type="text/css">

        <!-- Styles -->
        <link href="{{ themes('css/bootstrap.css') }}" rel="stylesheet">
    </head>
    <body>
        <div id="app">
            <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
                <div class="container">
                    <a class="navbar-brand" href="{{ url('/') }}">{{ config('app.name', 'SimpliCMS') }}</a>
                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                            @include('partials.menu.main', ['menu' => Core::getMenu('Main Menu')])
                        </ul>
                        @guest
                        <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                            @include('partials.menu.main', ['menu' => Core::getMenu('Guest Menu')])
                        </ul>
                        @else
                        <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
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
        <script src="{{ themes('js/alpine.js') }}"></script>
        <script src="{{ themes('js/jquery.js') }}"></script>
        <script src="{{ themes('js/bootstrap.bundle.js') }}"></script>
        @stack('scripts')
    </body>
</html>