<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Walk The Dog {{ isset($title) ? '- ' . $title : '' }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}"></script>

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

    {{-- favicon --}}
    <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('images/apple-touch-icon.png') }}">
    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('images/favicon-32x32.png') }}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('images/favicon-16x16.png') }}">
    <link rel="manifest" href="{{ asset('images/site.webmanifest') }}">
    <link rel="mask-icon" href="{{ asset('images/safari-pinned-tab.svg') }}/" color="#5bbad5">
    <meta name="msapplication-TileColor" content="#da532c">
    <meta name="theme-color" content="#ffffff">

    {{-- social - Facebook --}}
    <meta property="og:url" content="{{ url()->current() }}">
    <meta property="og:type" content="website">
    <meta property="og:title" content="Walk The Dog {{ isset($title) ? '- ' . $title : '' }}">
    <meta property="og:image" content="{{ isset($og_image) ? $og_image : asset('images/logo-full.png') }}">
    <meta property="og:image:alt" content="Walk The Dog logo with text">
    <meta property="og:description"
        content="{{ isset($description) ? $description : 'Find a place to walk your dog' }}">
    <meta property="og:site_name" content="Walk The Dog">
    <meta property="og:locale" content="en_GB">

    {{-- social - twitter --}}
    <meta name="twitter:card" content="summary">
    <meta name="twitter:url" content="{{ url()->current() }}">
    <meta name="twitter:title" content="Walk The Dog {{ isset($title) ? '- ' . $title : '' }}">
    <meta name="twitter:description"
        content="{{ isset($description) ? $description : 'Find a place to walk your dog' }}">
    <meta name="twitter:image" content="{{ isset($og_image) ? $og_image : asset('images/logo-full.png') }}">
    <meta name="twitter:image:alt" content="Walk The Dog logo with text">
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    @livewireStyles

</head>

<body>
    <div id="app">
        <nav class="navbar sticky-top navbar-expand-lg navbar-dark bg-dark unselectable">
            <div class="container">
                <a class="navbar-brand text-white" href="/">
                    <img src="{{ asset('images/logo-dog.png') }}" alt="logo" height="35"
                        class="d-inline-block align-text-center">
                    Walk The Dog
                </a>
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
                            <a class="nav-link {{ Request::is('place/*/add') ? 'active' : '' }}"
                                href="{{ route('add-new-place') }}">Add New Place</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ Request::is('contact*') ? 'active' : '' }}"
                                href="{{ route('contact') }}">Contact</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ Request::is('about*') ? 'active' : '' }}"
                                href="{{ route('about') }}">About</a>
                        </li>
                    </ul>

                    <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                        <form class="my-auto" action="{{ route('home') }}" method="GET">
                            {{-- @csrf --}}
                            <div class="input-group my-auto px-0 px-md-2">
                                <input class="form-control form-control-sm" type="text" name="search"
                                    placeholder="Search..." value="{{ Request::get('search') }}">
                                <button class="btn btn-sm btn-outline-success" type="submit">
                                    <i class="fa fa-search" aria-hidden="true"></i>
                                </button>
                            </div>
                        </form>

                        <!-- Authentication Links -->
                        <li class="nav-item dropdown">
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
                            <a class="nav-link dropdown-toggle {{ Request::is('dashboard*') ? 'active' : '' }}"
                                id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                {{ Str::ucfirst(Auth::user()->name) }}
                            </a>
                            <ul class="dropdown-menu" style="right: 0px; left: auto" aria-labelledby="navbarDropdown">
                                <li><a class="dropdown-item {{ Request::is('dashboard') ? 'active' : '' }}"
                                        href="{{ route('dashboard') }}">My Places</a></li>
                                @hasanyrole('editor|super-user')
                                    <li><a class="dropdown-item {{ Request::is('dashboard/all_places') ? 'active' : '' }}"
                                            href="{{ route('dashboard.all_places') }} ">All Places</a></li>
                                    <li><a class="dropdown-item {{ Request::is('dashboard/pending') ? 'active' : '' }}"
                                            href="{{ route('dashboard.pending') }}">Pending</a></li>
                                @endhasanyrole
                                @can('super-user')
                                    <li><a class="dropdown-item {{ Request::is('dashboard/users') ? 'active' : '' }}"
                                            href="{{ route('dashboard.users') }}">Users</a></li>
                                @endcan
                                <li><a class="dropdown-item {{ Request::is('dashboard/settings') ? 'active' : '' }}"
                                        href="{{ route('dashboard.settings') }}">Settings</a></li>
                                <li>
                                    <hr class="dropdown-divider">
                                </li>
                                <li>
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                        onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                </li>
                            </ul>
                            </li>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                @csrf
                            </form>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>


        <main style="min-height: calc(100vh - 8.25rem)">
            @if (\Session::has('success'))
                <div class="container">
                    <div class="alert mt-4 alert-success alert-dismissible fade show container mb-0" role="alert">
                        {!! \Session::get('success') !!}
                        <button type="button" class="btn-close" data-bs-dismiss="alert"
                            aria-label="Close"></button>
                    </div>
                </div>
            @endif
            @if (\Session::has('error'))
                <div class="container">
                    <div class="alert mt-4 alert-danger alert-dismissible fade show mb-0" role="alert">
                        {!! \Session::get('error') !!}
                        <button type="button" class="btn-close" data-bs-dismiss="alert"
                            aria-label="Close"></button>
                    </div>
                </div>
            @endif
            @if (\Session::has('warning'))
                <div class="container">
                    <div class="alert mt-4 alert-warning alert-dismissible fade show mb-0" role="alert">
                        {!! \Session::get('warning') !!}
                        <button type="button" class="btn-close" data-bs-dismiss="alert"
                            aria-label="Close"></button>
                    </div>
                </div>
            @endif

            @yield('content')
        </main>
        <footer class="bottom py-2 mt-auto bg-dark">
            <div class="row mx-0 px-3 justify-content-between text-white">
                <div class="col-12 col-md-5 my-3 text-center text-md-start">© 2022 - Walk The Dog</div>
                <div class="col-12 col-md-5 my-3 text-center text-md-end">Made with <i
                        class="fa fa-heart text-danger mx-1" aria-hidden="true"></i> by <a
                        class="text-decoration-none text-success" href="https://github.com/majster-pl" target="_blank"
                        rel="noreferrer"> Szymon Waliczek
                    </a>
                </div>
            </div>
        </footer>
    </div>

    <script>
        window.addEventListener('swal:modal', event => {
            new Swal({
                title: event.detail.message,
                text: event.detail.text,
                icon: event.detail.type,
                footer: event.detail.footer,
                confirmButtonColor: event.detail.confirmButtonColor,
            });
        });

        window.addEventListener('swal:confirm', event => {
            new Swal({
                    title: event.detail.message,
                    text: event.detail.text,
                    icon: event.detail.type,
                    buttons: true,
                    dangerMode: true,
                })
                .then((willDelete) => {
                    if (willDelete) {
                        window.livewire.emit('remove');
                    }
                });
        });
    </script>


    @livewireScripts
</body>

</html>
