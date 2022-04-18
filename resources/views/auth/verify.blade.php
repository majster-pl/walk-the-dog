@extends('layouts.app')

@section('content')
    <div class="container py-4">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header fs-4">{{ __('Verify Your Email Address') }}</div>

                    <div class="card-body">
                        @if (session('resent'))
                            <p class="fs-5">
                            <div class="alert alert-success" role="alert">
                                {{ __('A fresh verification link has been sent to your email address.') }}
                            </div>
                            </p>
                        @endif
                        <p class="fs-5">
                            {{ __('Before proceeding, please check your email for a verification link.') }}
                            {{ __('If you did not receive the email') }}
                        </p>
                        <form class="d-inline" method="POST" action="{{ route('verification.resend') }}">
                            @csrf
                            <button type="submit"
                                class="btn btn-link p-0 m-0 align-baseline">{{ __('click here to request another') }}</button>.
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
