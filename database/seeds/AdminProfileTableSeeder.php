<?php

use Illuminate\Database\Seeder;
use App\AdminProfile;
use App\User;

class AdminProfileTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('adminprofiles')->delete();
        AdminProfile::create([
            'user_id' => '1',
            'id' => 'ABC123',
            'name' => 'Mohamad Arif Bin Hakim',
            'email' => 'arifhakim@admin.com',
            'address' => 
'18 Home Sweet Home,
Taman Kembang,
43300 Seri Kembangan,
Selangor.',
            'phonenumber' => '0182847671',
            'homenumber' => '0389485858',
        ]); 
        
        AdminProfile::create([
            'user_id' => '2',
            'id' => 'ABX124',
            'name' => 'King of The North Pole',
            'email' => 'admin2@admin.com',
            'address' => 
'25 Street,
Taman Kerinching',
            'phonenumber' => '7845268755',
            'homenumber' => '985632458',
        ]);
    }
}
