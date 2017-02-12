<?php

use Illuminate\Database\Seeder;
use App\Semester;

class SemesterTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \DB::table('semesters')->delete();
        //1
        Semester::create([
            'semester' => 'Semester 1 2016/2017',
            'start' => '2016-06-01',
            'end' => '2016-09-30',
            'status' => '1',
        ]);

        //2
        Semester::create([
            'semester' => 'Semester 2 2016/2017',
            'start' => '2016-10-01',
            'end' => '2017-02-28',
            'status' => '1',
        ]);

        //3
        Semester::create([
            'semester' => 'Special Semester 2016/2017',
            'start' => '2017-03-01',
            'end' => '2017-05-31',
            'status' => '1',
        ]);

        //4
        Semester::create([
            'semester' => 'Semester 1 2017/2018',
            'start' => '2017-06-01',
            'end' => '2017-09-30',
            'status' => '1',
        ]);

        //5
        Semester::create([
            'semester' => 'Semester 2 2017/2018',
            'start' => '2017-10-01',
            'end' => '2018-02-28',
            'status' => '1',
        ]);
        //6
        Semester::create([
            'semester' => 'Special Semester 2017/2018',
            'start' => '2018-03-01',
            'end' => '2018-05-31',
            'status' => '1',
        ]);
    }
}
