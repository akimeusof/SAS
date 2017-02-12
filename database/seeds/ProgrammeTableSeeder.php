<?php

use Illuminate\Database\Seeder;
use App\Programme;

class ProgrammeTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('programmes')->delete();
        Programme::create([
            'name' => 'Bachelor of Computer Science (Cyber Security) (Hons.)',
            'status' => 1
        ]);
        Programme::create([
            'name' => 'Bachelor of Computer Science (Software Engineering) (Hons.)',
            'status' => 1
        ]);
        Programme::create([
            'name' => 'Bachelor of Computer Science (Systems & Networking) (Hons.)',
            'status' => 1
        ]);
        Programme::create([
            'name' => 'Bachelor of Information Technology (Graphics & Multimedia) (Hons.)',
            'status' => 1
        ]);
        Programme::create([
            'name' => 'Bachelor of Information Technology (Information System) (Hons.)',
            'status' => 1
        ]);
        Programme::create([
            'name' => 'Bachelor of Information Technology (Visual Media) (Hons.)',
            'status' => 1
        ]);
    }
}
