@extends('layouts.master')

@section('title', __('main.register'))
@section('content')
    <div class="container-fluid p-0 auth-page">
        <div class="row g-0 min-vh-100">
            <div class="col-lg-6 login-visual d-none d-lg-flex"
                style="--login-visual-image: url('https://freddds-project.web.app/assets/DSC04011.webp')">
                <div class="login-visual__overlay"></div>
                <div class="login-visual__content">
                </div>
            </div>
            <div class="col-12 col-lg-6 d-flex justify-content-center align-items-center p-4">
                <div class="card auth-card">
                    <h2 class="auth-card__title">{{ __('main.register') }}</h2>
                    <p class="auth-card__subtitle">{{ __('main.auth.register_subtitle') }}</p>
                    <form action="{{ route('register.do') }}" method="POST">
                        @csrf
                        <div class="my-2">
                            <label for="">{{ __('main.auth.username') }}</label>
                            <input type="text" name="username" id="" class="form-control"
                                value="{{ old('username') }}">
                        </div>
                        <div class="my-2">
                            <label for="">{{ __('main.auth.password') }}</label>
                            <input type="password" name="password" id="" class="form-control">
                        </div>
                        <div class="my-2">
                            <label for="">{{ __('main.auth.confirm_password') }}</label>
                            <input type="password" name="password_confirmation" id="" class="form-control">
                        </div>
                        @include('components.error_messages')
                        <button type="submit" class="mt-2 btn btn-primary w-100">{{ __('main.register') }}</button>
                    </form>
                    <p class="mt-3 text-center text-muted">
                        {{ __('main.auth.have_account') }}
                        <a href="{{ route('login.view') }}" class="text-primary text-decoration-underline fw-semibold">
                            {{ __('main.auth.login_here') }}
                        </a>
                    </p>
                </div>
            </div>
        </div>
    </div>
@endsection
