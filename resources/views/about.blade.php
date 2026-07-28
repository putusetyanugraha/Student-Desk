@extends('layouts.master')

@section('title', 'About')

@section('content')
    @include('layouts.navbar')
    <main class="container page-shell">
        <div class="card form-card p-4 p-md-5 text-center">
            <p class="text-info fw-semibold text-uppercase mb-2">About</p>
            <h1 class="page-title mb-3">About Page!</h1>
            <p class="page-subtitle mb-0">Manage student records and academic performance in one simple place.</p>
        </div>
    </main>
@endsection
