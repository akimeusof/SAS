<?php

use Illuminate\Database\Seeder;
use App\Subject;
class SubjectTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('subjects')->delete();
        
        //1
        Subject::create([
            'code' => 'CSEB534',
            'name' => 'Java Programming',
            'totalchapter' => '9',
            'status' => 1,
        ]);
        
        //2
        Subject::create([
            'code' => 'CSNB544',
            'name' => 'Mobile Application Development',
            'totalchapter' => '10',
            'status' => 1,
        ]);

        //3
        Subject::create([
            'code' => 'CSEB334',
            'name' => 'Object Oriented Programming',
            'totalchapter' => '11',
            'status' => 1,
        ]);

        //4
        Subject::create([
            'code' => 'CSEB544',
            'name' => 'Secure Programming',
            'totalchapter' => '8',
            'status' => 1,
        ]);

        //5
        Subject::create([
            'code' => 'CSEB294',
            'name' => 'Web Programing',
            'totalchapter' => '6',
            'status' => 1,
        ]);
    }
}
