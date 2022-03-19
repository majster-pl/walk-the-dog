<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Walk The Dog - Find a place to walk your pet</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>

<body>
    <div id="app">
        <nav class="navbar sticky-top navbar-expand-lg navbar-dark bg-dark">
            <div class="container-fluid">
                <a class="navbar-brand text-white" href="/">Walk The Dog</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarTogglerDemo01" aria-controls="navbarTogglerDemo01" aria-expanded="false"
                    aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarTogglerDemo01">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                        <li class="nav-item">
                            <a class="nav-link {{ Request::is('/') ? 'active' : '' }}" aria-current="page"
                                href="{{ route('home') }}">Home</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ Request::is('places*') ? 'active' : '' }}"
                                href="{{ route('places') }}">Places</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ Request::is('add-new-place*') ? 'active' : '' }}"
                                href="{{ route('add-new-place') }}">Add New Place</a>
                        </li>
                    </ul>

                    <ul class="navbar-nav ms-auto">
                        <!-- Authentication Links -->
                        @guest
                            @if (Route::has('login'))
                                <li class="nav-item">
                                    <a class="nav-link {{ Request::is('login*') ? 'active' : '' }}"
                                        href="{{ route('login') }}">{{ __('Login') }}</a>
                                </li>
                            @endif

                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link {{ Request::is('register*') ? 'active' : '' }}"
                                        href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                            @endif
                        @else
                            <li class="nav-item">
                                <a class="nav-link {{ Request::is('dashboard*') ? 'active' : '' }}"
                                    href="{{ route('dashboard') }}">{{ Str::ucfirst(Auth::user()->name) }}</a>
                            </li>

                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('logout') }}"
                                    onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                    {{ __('Logout') }}
                                </a>
                            </li>

                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                @csrf
                            </form>

                        @endguest
                    </ul>
                </div>
            </div>
        </nav>


        <main>
            @yield('content')
        </main>
        <footer class="footer mt-auto py-3 bg-dark">
            <div class="container">
                <span class="text-white">
                    Copyright © 2022 - 
                    <a class="text-decoration-none" href="https://github.com/majster-pl" target="_blank"
                        rel="noreferrer">
                        Szymon Waliczek 
                        <i class="fa fa-github" style="font-size: 1.2rem" aria-hidden="true"></i>
                    </a>
                </span>
            </div>
        </footer>
    </div>
</body>

</html>
