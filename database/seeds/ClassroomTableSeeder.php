<?php

use Illuminate\Database\Seeder;
use App\Classroom;

class ClassroomTableSeeder extends Seeder
{
    public function run()
    {
        DB::table('classrooms')->delete();
        //1
        Classroom::create([
            'user_id' => '3',
            'subject_id' => '5',
            'semester_id' => '1',
            'enrollmentkey' => bcrypt('123456789'),
            'section' => '1A',
            'capacity' => '5',
            'status' => '1',
        ]);

        //2
        Classroom::create([
            'user_id' => '3',
            'subject_id' => '5',
            'semester_id' => '1',
            'enrollmentkey' => bcrypt('123456789'),
            'section' => '1B',
            'capacity' => '60',
            'status' => '1',
        ]);

        //3
        Classroom::create([
            'user_id' => '3',
            'subject_id' => '1',
            'semester_id' => '1',
            'enrollmentkey' => bcrypt('123456789'),
            'section' => '1',
            'capacity' => '30',
            'status' => '1',
        ]);

        //4
        Classroom::create([
            'user_id' => '3',
            'subject_id' => '1',
            'semester_id' => '1',
            'enrollmentkey' => bcrypt('123456789'),
            'section' => '2',
            'capacity' => '30',
            'status' => '1',
        ]);
    }
}
