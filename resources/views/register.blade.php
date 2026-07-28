@extends('layouts.master')

@section('title', 'Register')
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
                    <h2 class="auth-card__title">Register</h2>
                    <p class="auth-card__subtitle">Create an account to get started.</p>
                    <form action="{{ route('register.do') }}" method="POST">
                        @csrf
                        <div class="my-2">
                            <label for="">Username</label>
                            <input type="text" name="username" id="" class="form-control"
                                value="{{ old('username') }}">
                        </div>
                        <div class="my-2">
                            <label for="">Password</label>
                            <input type="password" name="password" id="" class="form-control">
                        </div>
                        <div class="my-2">
                            <label for="">Confirm Password</label>
                            <input type="password" name="password_confirmation" id="" class="form-control">
                        </div>
                        @include('components.error_messages')
                        <button type="submit" class="mt-2 btn btn-primary w-100">Register</button>
                    </form>
                    <p class="mt-3 text-center text-muted">
                        Already have an account?
                        <a href="{{ route('login.view') }}" class="text-primary text-decoration-underline fw-semibold">
                            Login here
                        </a>
                    </p>
                </div>
            </div>
        </div>
    </div>
@endsection
