@extends('layouts.master')

@section('title', __('main.student.create_title'))
@section('content')
    @include('layouts.navbar')
    <main class="container page-shell">
        <div class="page-header">
            <div>
                <h1 class="page-title">{{ __('main.student.create_title') }}</h1>
                <p class="page-subtitle">{{ __('main.student.create_subtitle') }}</p>
            </div>
            <a href="{{ route('home') }}" class="btn btn-outline-primary">{{ __('main.student.back_to_students') }}</a>
        </div>
        <div class="card form-card">
            <form action="{{ route('students.insert') }}" method="POST">
                @csrf
                <div class="mb-3">
                    <label class="form-label">{{ __('main.student.name_label') }}</label>
                    <input type="text" class="form-control" name="student_name" value="{{ old('student_name') }}">
                </div>
                <div class="mb-3">
                    <label class="form-label">{{ __('main.student.nim_label') }}</label>
                    <input type="text" class="form-control" name="student_nim" value="{{ old('student_nim') }}">
                </div>
                @include('components.error_messages')
                <div class="form-actions">
                    <a href="{{ route('home') }}" class="btn btn-light">{{ __('main.student.cancel') }}</a>
                    <button type="submit" class="btn btn-primary">{{ __('main.student.save_add') }}</button>
                </div>
            </form>
        </div>
    </main>

@endsection
