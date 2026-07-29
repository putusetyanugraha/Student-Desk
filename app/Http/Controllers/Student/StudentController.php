<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Models\Courses;
use App\Models\Scores;
use App\Models\Students;
use App\Services\ScorePredictionService;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    public function detail(string $id)
    {
        $data = Students::where('id', $id)->first();
        $courses = Courses::get();
        $scores = Scores::with('courses')->where('student_id', $id)->get();
        return view('students.detail', compact('data', 'courses', 'scores'));
    }

    public function showCreate(){
        return view('students.create');
    }

    public function insertStudent(Request $request){
        $validated = $request->validate([
            'student_name' => ['required'],
            'student_nim' => ['required', 'numeric', 'unique:students,nim']
        ]);

        $name = $validated['student_name'];
        $nim = $validated['student_nim'];

        $process = Students::create([
            'name' => $name,
            'nim' => $nim,
        ]);

        if($process){
            return redirect()->route('home');
        } else {
            // return back()->withInput()->with('error_messages', 'terjadi kesalahan saat insert!');
            return back()->withInput()->withErrors([
                'insert_student' => 'Terjadi kesalahan saat insert!'
            ]);
        }
    }

    public function showEdit(string $id)
    {
        if($id == null || $id == 0){
            return back();
        }

        $student = Students::firstWhere('id', $id);

        return view('students.edit', compact('student'));
    }

    public function studentUpdate(string $id, Request $request)
    {
        $validated = $request->validate([
            'student_name' => ['required'],
            'student_nim' => ['required', 'numeric', 'unique:students,nim,' . $id]
        ]);

        $new_name = $validated['student_name'];
        $new_nim = $validated['student_nim'];

        $student = Students::firstWhere('id', $id);

        if($student == null){
            return back();
        }

        $updated_data = [];

        if($new_name != $student->name){
            $updated_data['name'] = $new_name;
        }

        if($new_nim != $student->nim){
            $updated_data['nim'] = $new_nim;
        }

        if(!empty($updated_data)){
            $student->update($updated_data);

            return redirect()->route('home');
        }

        return back()->withInput();
    }

    public function studentDelete(string $id)
    {
        $student = Students::where('id', $id)->first();

        if($student){
            $student->delete();

            return redirect()->route('home');
        }

        return back();
    }

    public function scoreDelete(string $scoreId)
    {
        $score = Scores::where('id', $scoreId)->first();

        if ($score) {
            $student_id = $score->student_id;
            $score->delete();

            return redirect()->route('students.detail', $student_id);
        }

        return back();
    }

    public function insertScore(Request $request)
    {
        $student_id = $request->input('student_id');
        $course_id = $request->input('course_id');
        $score = $request->input('score');
        $attendence = $request->input('attendence');
        $assigment = $request->input('assigment');
        $mid = $request->input('mid');
        $final = $request->input('final');

        $insertData = Scores::create([
            'student_id' => $student_id,
            'course_id' => $course_id,
            'score' => $score,
            'attendence' => $attendence,
            'assigment' => $assigment,
            'mid_exam' => $mid,
            'final_exam' => $final,
        ]);

        if($insertData){
            return redirect()->route('students.detail', $student_id);
        }

        return back()->withInput();
    }

    public function predictScore($id, ScorePredictionService $classifier)
    {
        $scores = Scores::where('student_id', $id)->get();

        if ($scores->isEmpty()) {
            return back()->with('error_messages', 'Tambahkan minimal satu nilai sebelum melakukan prediksi.');
        }

        $attendence = $scores->avg('attendence');
        $assigment = $scores->avg('assigment');
        $mid_exam = $scores->avg('mid_exam');
        $final_exam = $scores->avg('final_exam');
        $result = $classifier->predict($attendence, $assigment, $mid_exam, $final_exam);

        $student = Students::findOrFail($id);
        $student->update(['prediction' => $result]);

        return redirect()->route('students.detail', $id);
    }
}
