@extends('layouts.master')

@section('title', __('main.student.edit_title'))
@section('content')
    @include('layouts.navbar')
    <main class="container page-shell">
        <div class="page-header">
            <div>
                <h1 class="page-title">Edit Student</h1>
                <p class="page-subtitle">Update the student identity details below.</p>
            </div>
            <a href="{{ route('home') }}" class="btn btn-outline-primary">Back to Students</a>
        </div>
        <div class="card form-card">
            <form action="{{ route('students.update', $student->id)}}" method="POST">
                @csrf
                @method('PATCH')
                <div class="mb-3">
                    <label class="form-label">Student Name:</label>
                    <input value="{{ old('student_name', $student->name) }}" type="text" class="form-control" name="student_name" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">Student Number:</label>
                    <input value="{{ old('student_nim', $student->nim) }}" type="text" class="form-control" name="student_nim" required>
                </div>
                @include('components.error_messages')
                <div class="form-actions">
                    <a href="{{ route('home') }}" class="btn btn-light">Cancel</a>
                    <button type="submit" class="btn btn-primary">Update Student</button>
                </div>
            </form>
        </div>
    </main>

@endsection
