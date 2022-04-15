@extends("layouts.app")

@section('content')
    <div class="container py-4">
        <div class="row justify-content-between">
            <div class="col-12 col-md-8">
                <ul class="nav nav-pills pb-3">
                    <li class="nav-item">
                        <a class="nav-link text-black {{ Request::is('dashboard') ? 'active' : '' }}" aria-current="page"
                            href="{{ route('dashboard') }}">My Places</a>
                    </li>
                    @hasanyrole('editor|super-user')
                        <li class="nav-item">
                            <a class="nav-link text-black position-relative {{ Request::is('dashboard/all_places') ? 'active' : '' }}"
                                href="{{ route('dashboard.all_places') }}">All Places
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-black position-relative {{ Request::is('dashboard/pending') ? 'active' : '' }}"
                                href="{{ route('dashboard.pending') }}">Pending
                                {{-- <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                            {{"99"}}
                            <span class="visually-hidden">unread messages</span>
                        </span> --}}
                            </a>
                        </li>
                    @endhasanyrole
                    @can('super-user')
                        <li class="nav-item">
                            <a class="nav-link text-black {{ Request::is('dashboard/users') ? 'active' : '' }}"
                                href="{{ route('dashboard.users') }}">Useers</a>
                        </li>
                    @endcan
                </ul>
            </div>
            <div class="col-12 col-md-4 text-end mb-3">
                @hasrole('user')
                    <div class="d-grid d-md-block gap-2">
                        <a class="btn-warning btn text-white" href="{{ route('contact', 'editor') }}">Become an editor</a>
                    </div>
                @endhasrole
            </div>
        </div>


        <div class="card">
            <div class="card-header fs-5">
                @yield('content-card-title')
            </div>
            <div class="card-body">
                @yield('content-card')
            </div>
        </div>
    </div>
@endsection
