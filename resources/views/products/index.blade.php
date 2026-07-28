@extends('layouts.master')

@section('title', 'Product List')

@section('content')
    @include('layouts.navbar')
    <main class="container page-shell">
        <div class="card form-card p-4 p-md-5 text-center">
            <p class="text-info fw-semibold text-uppercase mb-2">Product</p>
            <h1 class="page-title mb-3">Product List</h1>
            <p class="page-subtitle mb-0">Browse the available product information from this page.</p>
        </div>
    </main>
@endsection
