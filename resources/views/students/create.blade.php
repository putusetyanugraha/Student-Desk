@extends('layouts.master')

@section('title', 'Add New Student')
@section('content')
    @include('layouts.navbar')
    <main class="container page-shell">
        <div class="page-header">
            <div>
                <h1 class="page-title">Add New Student</h1>
                <p class="page-subtitle">Create a new student record for the directory.</p>
            </div>
            <a href="{{ route('home') }}" class="btn btn-outline-primary">Back to Students</a>
        </div>
        <div class="card form-card">
            <form action="{{ route('students.insert')}}" method="POST">
                @csrf
                <div class="mb-3">
                    <label class="form-label">Student Name:</label>
                    <input type="text" class="form-control" name="student_name" value="{{ old('student_name') }}">
                </div>
                <div class="mb-3">
                    <label class="form-label">Student Number:</label>
                    <input type="text" class="form-control" name="student_nim" value="{{ old('student_nim') }}">
                </div>
                @include('components.error_messages')
                <div class="form-actions">
                    <a href="{{ route('home') }}" class="btn btn-light">Cancel</a>
                    <button type="submit" class="btn btn-primary">Add Student</button>
                </div>
            </form>
        </div>
    </main>

@endsection
