@extends('layouts.master')

@section('title', 'Product Detail')

@section('content')
    @include('layouts.navbar')
    <main class="container page-shell">
        <div class="card form-card p-4 p-md-5 text-center">
            <p class="text-info fw-semibold text-uppercase mb-2">Product Detail</p>
            <h1 class="page-title mb-3">Product ID {{ $productId }}</h1>
            <p class="page-subtitle mb-0">View the detail for the selected product.</p>
        </div>
    </main>
@endsection
