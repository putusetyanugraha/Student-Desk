@extends('layouts.master')

@section('title', 'Login')
@section('content')
    <div class="container-fluid p-0 auth-page">
        <div class="row g-0 min-vh-100">
            <div class="col-lg-6 login-visual d-none d-lg-flex">
                <div class="login-visual__overlay"></div>
                <div class="login-visual__content">
                </div>
            </div>
            <div class="col-12 col-lg-6 d-flex justify-content-center align-items-center p-4">
                <div class="card auth-card">
                    <h2 class="auth-card__title">{{ __('main.login') }}</h2>
                    <p class="auth-card__subtitle">Welcome back. Please enter your account details.</p>
                    <form action="{{ route('login.do') }}" method="POST">
                        @csrf
                        <div class="my-2">
                            <label for="username">Username</label>
                            <input type="text" name="username" id="" class="form-control"
                                value="{{ old('username') }}">
                        </div>

                        <div class="my-2">
                            <label for="password">Password</label>
                            <input type="password" name="password" id="" class="form-control">
                        </div>

                        @if (session('error_messages'))
                            <div class="alert alert-danger mt-3">{{ session('error_messages') }}</div>
                        @endif
                        @include('components.error_messages')

                        {{-- @error('username')
                            <div class="alert alert-danger mt-3">{{ $messages }}</div>
                        @enderror --}}
                        {{-- @if ($errors->any())
                            <div class="alert alert-danger mt-3">
                                <ul class="mb-0">
                                    @foreach ($errors->all() as $err)
                                        <li>{{err}}</li>                                        
                                    @endforeach
                                </ul>
                            </div>
                        @endif --}}

                        <button class="mt-2 btn btn-primary w-100" type="submit">{{ __('main.login') }}</button>
                    </form>
                    <p class="mt-3 text-center text-muted">
                        Don't have an account?
                        <a href="{{ route('register.view') }}" class="text-primary text-decoration-underline fw-semibold">
                            Register here
                        </a>
                    </p>
                </div>
            </div>
        </div>
    </div>
@endsection
