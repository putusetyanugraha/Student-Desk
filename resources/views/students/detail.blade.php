@extends('layouts.master')

@section('title', 'Detail Student')
@section('content')
    @include('layouts.navbar')
    <main class="container page-shell">
        @include('components.error_messages')
        <div class="page-header">
            <div>
                <h1 class="page-title">Student Detail</h1>
                <p class="page-subtitle">Review student information, predicted status, and scores.</p>
            </div>
            <a class="btn btn-outline-primary" href="{{ route('home') }}">Back to Students</a>
        </div>
        <div class="card detail-summary">
            <div class="card-body">
                <h2 class="h4 mb-2">{{$data->name}}</h2>
                <p class="text-secondary mb-3">Student Number: {{$data->nim}}</p>
                <p class="mb-3">Prediction: <span class="status-value">{{blank($data->prediction) ? '-' : ($data->prediction ? 'Telat' : 'Tepat Waktu')}}</span></p>
                <form action="{{ route('students.predict', $data->id) }}" method="POST">
                    @csrf
                    <button class="btn btn-sm btn-info" type="submit">Predict Status</button>
                </form>
            </div>
        </div>

        <div class="card mt-4">
            <div class="card-body">
                <h2 class="h5 mb-4">Add Score</h2>
                <form action="{{ route('students.scores.insert') }}" method="POST">
                    @csrf
                    <input type="hidden" name="student_id" value="{{ $data->id }}">
                    <div class="row g-3">
                        <div class="col-md-4">
                            <label for="" class="form-label">Course</label>
                            <select name="course_id" class="form-select" required>
                                <option value="" disabled selected>-- Select Course --</option>
                                @foreach ($courses as $course)
                                    <option value="{{ $course->id }}">{{ $course->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-4">
                            <label for="" class="form-label">Attendance Percentage (0 - 100)</label>
                            <input type="number" name="attendence" class="form-control" required min="0" max="100">
                        </div>
                        <div class="col-md-4">
                            <label for="" class="form-label">Assigment (0 - 100)</label>
                            <input type="number" name="assigment" class="form-control" required min="0" max="100">
                        </div>
                        <div class="col-md-4">
                            <label for="" class="form-label">Mid Exam (0 - 100)</label>
                            <input type="number" name="mid" class="form-control" required min="0" max="100">
                        </div>
                        <div class="col-md-4">
                            <label for="" class="form-label">Final Exam (0 - 100)</label>
                            <input type="number" name="final" class="form-control" required min="0" max="100">
                        </div>
                        <div class="col-md-4">
                            <label for="" class="form-label">Score (0 - 100)</label>
                            <input type="number" name="score" class="form-control" required min="0" max="100">
                        </div>
                    </div>
                    <div class="col-12 mt-3">
                        <button type="submit" class="btn btn-success">Save Score</button>
                    </div>
                </form>
            </div>
        </div>


        <div class="card data-card mt-4">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-hover align-middle">
                    <thead>
                        <tr>
                            <th>Course</th>
                            <th>Attendece</th>
                            <th>Assigment</th>
                            <th>Final</th>
                            <th>Mid</th>
                            <th>Score</th>
                            <th>Grade</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($scores as $score)
                            @php
                                if ($score->score >= 90 && $score->score <= 100) {
                                    $grade = 'A';
                                } else if ($score->score >= 85 && $score->score <= 89) {
                                    $grade = 'A-';
                                } else if ($score->score >= 80 && $score->score <= 84) {
                                    $grade = 'B+';
                                } else if ($score->score >= 75 && $score->score <= 79) {
                                    $grade = 'B';
                                } else {
                                    $grade = 'Kacaw!';
                                }
                            @endphp
                        <tr>
                            <td>{{ $score->courses->code }} - {{$score->courses->name}}</td>
                            <td>{{$score->attendence}}%</td>
                            <td>{{$score->assigment}}</td>
                            <td>{{$score->mid_exam}}</td>
                            <td>{{$score->final_exam}}</td>
                            <td>{{$score->score}}</td>
                            <td>{{$grade}}</td>
                            <td></td>
                        </tr>
                        @endforeach
                    </tbody>

                    </table>
                </div>
            </div>
        </div>
    </main>
@endsection
