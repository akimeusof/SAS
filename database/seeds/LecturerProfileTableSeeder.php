<?php

use Illuminate\Database\Seeder;
use App\User;
use App\LecturerProfile;
class LecturerProfileTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('lecturerprofiles')->delete();
        //3
        LecturerProfile::create([
            'user_id' => '3',
            'id' => 'ST123456',
            'name' => 'Ahmad Bin Abu',
            'email' => 'ahmadabu@gmail.com',
            'address' => 
'3487 Jalan 18/59,
Taman Sri Serdang,
43300, Seri Kembangan,
Selangor Darul Ehsan.',
            'phonenumber' => '0182847671',
            'homenumber' => '0389485858',
        ]);
        
        //4
        LecturerProfile::create([
            'user_id' => '4',
            'id' => 'SP987987',
            'name' => 'Samad Bin Ahmad',
            'email' => 'samad@gmail.com',
            'address' => 
'14 Jalan 12,
Taman Bunga', 
            'phonenumber' => '0137894526', 
            'homenumber' => '0125896374',]);
        
        //5
        LecturerProfile::create([
            'user_id' => '5',
            'id' => 'SB123456',
            'name' => ' Mick Allen',
            'email' => 'mickallen@yahoo.com',
            'address' => 
'12 Jalan 9,
Taman Sana',
            'phonenumber' => '0134567812',
            'homenumber' => '0585692415',
        ]);
        
        //6
        LecturerProfile::create([
            'user_id' => '6',
            'id' => 'SB123456',
            'name' => 'Lily Style',
            'email' => 'lily@email.com',
            'address' => 
'34 Nananana Road,
The City of Batman,
Gotham.',
            'phonenumber' => '0182847671',
            'homenumber' => '0389485858',
        ]);
        
        //7
        LecturerProfile::create([
            'user_id' => '7',
            'id' => 'SB123456',
            'name' => 'Muhamad Zack Bin Khir',
            'email' => 'lecturer5@uniten.com',
            'address' => 
'1818 Jalan 18,
Taman Lapan Satu,
81818 Eight Town,
Selangor Darul Ehsan.',
            'phonenumber' => '0173543637',
            'homenumber' => '0389425105',
        ]);
    }

}
