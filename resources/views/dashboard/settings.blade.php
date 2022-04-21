@extends('layouts.dashboard', ['title' => 'User Setting'])

@section('content-card-title')
    <span class="fs-4">
        User Settings
    </span>
@endsection

@section('content-card')
    <div class="row">
        <div class="col col-12 col-md-6 mb-4">
            <div class="card">
                <div class="card-header">General</div>
                <div class="card-body">
                    <form action="{{ route('dashboard.settings') }}" method="POST">
                        @csrf
                        @method('PATCH')
                        <div class="mb-3">
                            <label for="userEmail" class="form-label">Email address:</label>
                            <input type="text" class="form-control" id="userEmail" name="email"
                                value="{{ $user->email ?? old('email') }}">
                            @error('email')
                                <div class="form-text text-danger">
                                    <strong>{{ $message }}</strong>
                                </div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="userName" class="form-label">Name:</label>
                            <input type="text" class="form-control" id="userName" name="name"
                                value="{{ $user->name ?? old('name') }}">
                            @error('name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <button type="submit" class="btn btn-info float-end">Update</button>
                    </form>
                </div>
            </div>
        </div>
        <div class="col col-12 col-md-6">
            <div class="card">
                <div class="card-header">Password</div>
                <div class="card-body">
                    <form action="{{ route('dashboard.settings') }}" method="POST">
                        @csrf
                        @method('PATCH')
                        <div class="mb-3 row">
                            <label for="password" class="col-md-4 col-form-label text-start text-md-end">
                                {{ __('New Password') }}:
                            </label>

                            <div class="col-md-6">
                                <input id="password" type="password"
                                    class="form-control @error('password') is-invalid @enderror" name="password"                                     autocomplete="new-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="mb-3 row">
                            <label for="password-confirm" class="col-md-4 col-form-label text-start text-md-end">
                                {{ __('Confirm Password') }}:
                            </label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="password"
                                    class="form-control @error('password') is-invalid @enderror"
                                    name="password_confirmation" autocomplete="new-password">
                            </div>
                            @error('password_confirmation')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <button type="submit" class="btn btn-info float-end">Update</button>
                    </form>
                </div>
            </div>
        </div>

    </div>
@endsection
