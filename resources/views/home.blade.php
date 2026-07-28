@extends('layouts.master')

@section('title', 'Homepage')
@section('content')
    @include('layouts.navbar')
    <main class="container page-shell">
        <div class="page-header">
            <div>
                <h1 class="page-title">Student Directory</h1>
                <p class="page-subtitle">Monitor student records and academic performance.</p>
            </div>

            <div class="d-flex gap-2">

                <form action="{{ route('home') }}" method="GET" class="d-flex">

                    <input type="text" name="search" class="form-control" placeholder="Search student..."
                        value="{{ request('search') }}">

                    <button class="btn btn-outline-primary ms-2">
                        Search
                    </button>

                </form>

                <a href="{{ route('students.create') }}" class="btn btn-primary">
                    Add New Student
                </a>

            </div>
        </div>
        <div class="card data-card">
            <div class="table-responsive">
                <table class="table table-hover align-middle">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Name</th>
                            <th>Average Score</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($students as $st)
                            @php
                                // $average = array_sum($st['score']) / count($st['score'])
                                $average = $st->getAverage();
                            @endphp
                            <tr>
                                <td>{{ $st['id'] }}</td>
                                <td><a href="{{ route('students.detail', $st['id']) }}">{{ $st['name'] }}</a></td>
                                <td>{{ round($average, 2) }}</td>
                                <td>
                                    @if ($average > 85)
                                        <span class="badge text-bg-success">{{ __('main.student.status_ok') }}</span>
                                    @else
                                        <span class="badge text-bg-danger">{{ __('main.student.status_fail') }}</span>
                                    @endif
                                </td>
                                <td>
                                    <div class="d-flex gap-2">
                                        <a href="{{ route('students.edit', $st->id) }}"
                                            class="btn btn-sm btn-warning">Edit</a>
                                        <form action="{{ route('students.delete', $st->id) }}" method="POST"
                                            class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-danger"
                                                onclick="return confirm('Delete student data?')">Delete</button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </main>
@endsection
