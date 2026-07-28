<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CourseSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('courses')->insert([
            [
                'name' => 'Algorithm and Programming',
                'code' => 'COMP6047',
            ],
            [
                'name' => 'Data Structures',
                'code' => 'COMP6048',
            ],
            [
                'name' => 'Object Oriented Programming',
                'code' => 'COMP6050',
            ],
            [
                'name' => 'Database Technology',
                'code' => 'COMP6053',
            ],
            [
                'name' => 'Web Programming',
                'code' => 'COMP6056',
            ],
            [
                'name' => 'Software Engineering',
                'code' => 'COMP6060',
            ],
            [
                'name' => 'Human and Computer Interaction',
                'code' => 'COMP6800',
            ],
            [
                'name' => 'Research Methodology',
                'code' => 'COMP6801',
            ],
            [
                'name' => 'Computational Biology',
                'code' => 'COMP6803',
            ],
            [
                'name' => 'Agile Software Development',
                'code' => 'COMP6804',
            ],
            [
                'name' => 'Artificial Intelligence',
                'code' => 'COMP6068',
            ],
            [
                'name' => 'Machine Learning',
                'code' => 'COMP6072',
            ],
            [
                'name' => 'Computer Graphics',
                'code' => 'COMP6076',
            ],
            [
                'name' => 'Multimedia Systems',
                'code' => 'COMP6070',
            ],
            [
                'name' => 'Operating Systems',
                'code' => 'COMP6063',
            ],
        ]);
    }
}