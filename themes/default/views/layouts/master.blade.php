<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <!-- CSRF Token -->
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="dns-prefetch" href="https://fonts.gstatic.com">
        <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet" type="text/css">

        <!-- Styles -->
        <link href="{{ themes('css/app.css') }}" rel="stylesheet">
        @include('layouts._favicons')
    </head>
    <body>
        <div id="app">
            <nav class="navbar navbar-expand-md navbar-dark navbar-laravel">
                <div class="container">
                    <a class="navbar-brand" href="{{ url('/') }}">
                        {{ config('app.name', 'Laravel') }}
                    </a>
                    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                        <span class="navbar-toggler-icon"></span>
                    </button>

                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        <!-- Left Side Of Navbar -->
                        {!! showMenu('Main menu') !!}

                        <!-- Right Side Of Navbar -->
                        <!-- Authentication Links -->
                        @guest
                        {!! showMenu('Guest menu', $alignment = 'right') !!}
                        @else
                        <ul class="navbar-nav ml-auto">
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('cart.show') }}">Cart
                                    @if (Cart::isNotEmpty())
                                    <span class="badge badge-pill badge-secondary">{{ Cart::itemCount() }}</span>
                                    @endif
                                </a>
                            </li>
                            @role('admin')
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('admin.index') }}">Admin</a>
                            </li>
                            @endrole
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }} <span class="caret"></span>
                                </a>

                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                               document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                            @endguest
                        </ul>
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