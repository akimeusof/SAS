<?php

use Illuminate\Database\Seeder;
use App\Enrollment;
class EnrollmentTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('enrollments')->delete();
        Enrollment::create([
            'user_id' => 9,
            'classroom_id' => 1,
            'status' => 1
        ]);
        
        Enrollment::create([
            'user_id' => 10,
            'classroom_id' => 1,
            'status' => 1
        ]);
        
        Enrollment::create([
            'user_id' => 11,
            'classroom_id' => 1,
            'status' => 1
        ]);
        
        Enrollment::create([
            'user_id' => 12,
            'classroom_id' => 1,
            'status' => 1
        ]);
    }
}
