<?php

use Illuminate\Database\Seeder;
use App\user;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \DB::table('users')->delete();
        //1
        User::create([
            'username' => 'admin',
            'password' => bcrypt('admin'),
            'type' => 'admin',
            'status' => 1
        ]);
        
        //2
        User::create([
            'username' => 'admin2',
            'password' => bcrypt('admin2'),
            'type' => 'admin',
            'status' => 1
        ]);

        //3
        User::create([
            'username' => 'lecturer',
            'password' => bcrypt('lecturer'),
            'type' => 'lecturer',
            'status' => 1
        ]);

        //4
        User::create([
            'username' => 'lecturer2',
            'password' => bcrypt('lecturer2'),
            'type' => 'lecturer',
            'status' => 1
        ]);

        //5
        User::create([
            'username' => 'lecturer3',
            'password' => bcrypt('lecturer3'),
            'type' => 'lecturer',
            'status' => 1
        ]); 
        
        //6
        User::create([
            'username' => 'lecturer4',
            'password' => bcrypt('lecturer4'),
            'type' => 'lecturer',
            'status' => 1
        ]); 
        
        //7
        User::create([
            'username' => 'lecturer5',
            'password' => bcrypt('lecturer5'),
            'type' => 'lecturer',
            'status' => 1
        ]);
        
        //8
        User::create([
            'username' => 'akim',
            'password' => bcrypt('akim'),
            'type' => 'student',
            'status' => 1
        ]);

        //9
        User::create([
            'username' => 'student',
            'password' => bcrypt('student'),
            'type' => 'student',
            'status' => 1
        ]); 
        
        //10
        User::create([
            'username' => 'student1',
            'password' => bcrypt('student1'),
            'type' => 'student',
            'status' => 1
        ]); 
        
        //11
        User::create([
            'username' => 'student2',
            'password' => bcrypt('student2'),
            'type' => 'student',
            'status' => 1
        ]); 
        
        //12
        User::create([
            'username' => 'student3',
            'password' => bcrypt('student3'),
            'type' => 'student',
            'status' => 1
        ]); 
        
        //13
        User::create([
            'username' => 'student4',
            'password' => bcrypt('student4'),
            'type' => 'student',
            'status' => 1
        ]); 
        
        //14
        User::create([
            'username' => 'student5',
            'password' => bcrypt('student5'),
            'type' => 'student',
            'status' => 1
        ]); 
        
        //15
        User::create([
            'username' => 'student6',
            'password' => bcrypt('student6'),
            'type' => 'student',
            'status' => 1
        ]); 
        
        //16
        User::create([
            'username' => 'student7',
            'password' => bcrypt('student7'),
            'type' => 'student',
            'status' => 1
        ]); 
        
        //17
        User::create([
            'username' => 'student8',
            'password' => bcrypt('student8'),
            'type' => 'student',
            'status' => 1
        ]); 
        
        //18
        User::create([
            'username' => 'student9',
            'password' => bcrypt('student9'),
            'type' => 'student',
            'status' => 1
        ]);
        
    }
}
