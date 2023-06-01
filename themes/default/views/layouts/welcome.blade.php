<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <!-- CSRF Token -->
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>@hasSection('title')@yield('title') &middot; @endif{{ config('app.name', 'SimpliCMS') }}</title>
        @include('layouts._favicons')
        <!-- Fonts -->
        <link rel="dns-prefetch" href="https://fonts.gstatic.com">
        <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet" type="text/css">

        <!-- Styles -->
        <link href="{{ themes('css/bootstrap.css') }}" rel="stylesheet">
        <link href="{{ themes('css/custom.css') }}" rel="stylesheet">
        @stack('style')
        <style>
            .bd-placeholder-img {
                font-size: 1.125rem;
                text-anchor: middle;
                -webkit-user-select: none;
                -moz-user-select: none;
                user-select: none;
            }

            @media (min-width: 768px) {
                .bd-placeholder-img-lg {
                    font-size: 3.5rem;
                }
            }

            .b-example-divider {
                height: 3rem;
                background-color: rgba(0, 0, 0, .1);
                border: solid rgba(0, 0, 0, .15);
                border-width: 1px 0;
                box-shadow: inset 0 .5em 1.5em rgba(0, 0, 0, .1), inset 0 .125em .5em rgba(0, 0, 0, .15);
            }

            .b-example-vr {
                flex-shrink: 0;
                width: 1.5rem;
                height: 100vh;
            }

            .bi {
                vertical-align: -.125em;
                fill: currentColor;
            }

            .nav-scroller {
                position: relative;
                z-index: 2;
                height: 2.75rem;
                overflow-y: hidden;
            }

            .nav-scroller .nav {
                display: flex;
                flex-wrap: nowrap;
                padding-bottom: 1rem;
                margin-top: -1px;
                overflow-x: auto;
                text-align: center;
                white-space: nowrap;
                -webkit-overflow-scrolling: touch;
            }
        </style>
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
                            @include('partials.menu.main', ['menuItems' => Core::getMenu('Main Menu')])
                        </ul>
                        @guest
                        <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                            @include('partials.menu.main', ['menuItems' => Core::getMenu('Guest Menu')])
                        </ul>
                        @else
                        <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                            @include('partials.menu.main', ['menuItems' => Core::getMenu('User Menu')])
                        </ul>
                        @endguest
                    </div>
                </div>
            </nav>

            <main>
                @yield('content')
            </main>
            @include('partials.layout._footer')
        </div>
        @include('partials.layout._js-vars')
        @stack('alpine')
        <!-- Scripts -->
        <script src="{{ themes('js/alpine.js') }}"></script>
        <script src="{{ themes('js/jquery.js') }}"></script>
        <script src="{{ themes('js/bootstrap.bundle.js') }}"></script>
        @stack('scripts')
    </body>
</html>