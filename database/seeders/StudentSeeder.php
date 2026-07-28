<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class StudentSeeder extends Seeder
{
    public function run(): void
    {
        $firstNames = [
            'Andi','Budi','Kevin','Michael','William',
            'Jessica','Cindy','Stefani','Michelle','Jonathan',
            'Bryan','Felix','Ricky','Samuel','Nicholas',
            'Calvin','Jordan','Richard','Nathan','Daniel'
        ];

        $lastNames = [
            'Saputra','Wijaya','Hartono','Santoso','Pratama',
            'Gunawan','Halim','Tan','Setiawan','Putra',
            'Lesmana','Kurniawan','Susanto','Hendra','Permana'
        ];

        $courses = DB::table('courses')->get();

        for ($i = 1; $i <= 50; $i++) {

            // ===========================
            // Tentukan tipe mahasiswa
            // ===========================
            $studentType = rand(1,100);

            if ($studentType <= 10) {
                // Top Student (10%)
                $attendanceRange = [95,100];
                $assignmentRange = [90,100];
                $midRange = [88,100];
                $finalRange = [90,100];

            } elseif ($studentType <= 35) {
                // Good Student (25%)
                $attendanceRange = [88,100];
                $assignmentRange = [82,95];
                $midRange = [78,90];
                $finalRange = [80,92];

            } elseif ($studentType <= 75) {
                // Average Student (40%)
                $attendanceRange = [80,95];
                $assignmentRange = [72,88];
                $midRange = [68,84];
                $finalRange = [70,86];

            } elseif ($studentType <= 90) {
                // Weak Student (15%)
                $attendanceRange = [70,85];
                $assignmentRange = [60,75];
                $midRange = [55,70];
                $finalRange = [55,72];

            } else {
                // Bad Student (10%)
                $attendanceRange = [40,70];
                $assignmentRange = [40,65];
                $midRange = [35,60];
                $finalRange = [35,60];
            }

            $studentId = DB::table('students')->insertGetId([
                'name' => $firstNames[array_rand($firstNames)] . ' ' .
                          $lastNames[array_rand($lastNames)],

                'nim' => '270' . str_pad($i, 7, '0', STR_PAD_LEFT),

                // nanti di-update setelah semua nilai selesai
                'prediction' => null,

                'created_at' => now(),
                'updated_at' => now(),
            ]);

            $totalScore = 0;
            $courseCount = 0;

            foreach ($courses as $course){

                $attendance = rand($attendanceRange[0], $attendanceRange[1]);
                $assignment = rand($assignmentRange[0], $assignmentRange[1]);
                $mid = rand($midRange[0], $midRange[1]);
                $final = rand($finalRange[0], $finalRange[1]);

                // Variasi kecil tiap mata kuliah
                $attendance += rand(-3,3);
                $assignment += rand(-5,5);
                $mid += rand(-6,6);
                $final += rand(-6,6);

                // Pastikan tetap 0-100
                $attendance = max(0, min(100, $attendance));
                $assignment = max(0, min(100, $assignment));
                $mid = max(0, min(100, $mid));
                $final = max(0, min(100, $final));

                // Bobot nilai
                $score = round(
                    ($attendance * 0.10) +
                    ($assignment * 0.30) +
                    ($mid * 0.25) +
                    ($final * 0.35)
                );

                DB::table('scores')->insert([
                    'student_id' => $studentId,
                    'course_id' => $course->id,

                    'score' => $score,

                    'attendence' => $attendance,
                    'assigment' => $assignment,
                    'mid_exam' => $mid,
                    'final_exam' => $final,

                    'created_at' => now(),
                    'updated_at' => now(),
                ]);

                $totalScore += $score;
                $courseCount++;
            }

            // Hitung rata-rata mahasiswa
            $averageScore = round($totalScore / $courseCount);

            DB::table('students')
                ->where('id', $studentId)
                ->update([
                    'prediction' => $averageScore >= 70
                ]);
        }
    }
}