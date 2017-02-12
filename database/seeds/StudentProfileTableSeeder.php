<?php

use Illuminate\Database\Seeder;
use App\User;
use App\StudentProfile;

class StudentProfileTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('studentprofiles')->delete();
        //8
        StudentProfile::create([
            'user_id' => '8',
            'id' => 'SW094683',
            'name' => 'Akim Bin Eusof',
            'email' => 'akim@gmail.com',
            'programme_id' => '2',
            'address' =>
'3487 Jalan 18/59,
Taman Sri Serdang,
43300 Seri Kembangan.',
            'phonenumber' => '0182847671',
            'homenumber' => '0389485858',
        ]);

        //9
        StudentProfile::create([
            'user_id' => '9',
            'id' => 'SW456789',
            'name' => 'Mia Elisa Bin Edhir',
            'email' => 'mia@gmail.com',
            'programme_id' => '2',
            'address' =>
'2 Jalan Kenanga,
Taman Indah Baru',
            'phonenumber' => '1234567891',
            'homenumber' => '123456891',
        ]);

        //10
        StudentProfile::create([
            'user_id' => '10',
            'id' => 'SW124565',
            'name' => 'Ayra Eleanor',
            'email' => 'ayra@gmail.com',
            'programme_id' => '2',
            'address' =>
'99 Jalan 17,
Condominium Baharu',
            'phonenumber' => '0152869752',
            'homenumber' => '3256984521',
        ]);

        //11
        StudentProfile::create([
            'user_id' => '11',
            'id' => 'SW453212',
            'name' => 'Aaron Brown',
            'email' => 'aaron@gmail.com',
            'programme_id' => '2',
            'address' =>
'46 Sunshine Road,
Bandar Tun Hussein,
43300 Seri Kembangan,
Selangor.',
            'phonenumber' => '0163125479',
            'homenumber' => '0896852415',
        ]);

        //12
        StudentProfile::create([
            'user_id' => '12',
            'id' => 'SW232334',
            'name' => 'Charlie Smith',
            'email' => 'charlie@gmail.com',
            'programme_id' => '2',
            'address' =>
'24 Baker Street,
Old Town,
Texas.',
            'phonenumber' => '0182847671',
            'homenumber' => '0389485858',
        ]);

        //13
        StudentProfile::create([
            'user_id' => '13',
            'id' => 'SW789234',
            'name' => 'Zaid Bin Ahmad',
            'email' => 'zaid@gmail.com',
            'programme_id' => '2',
            'address' =>
'16 Jalan Damansara,
Bukit Damansara,
41212 Damansara,
Selangor Darul Ehsan.',
            'phonenumber' => '0182847671',
            'homenumber' => '0389485858',
        ]);

        //14
        StudentProfile::create([
            'user_id' => '14',
            'id' => 'SW234654',
            'name' => 'Amalina Bin Tahar',
            'email' => 'amalina@gmail.com',
            'programme_id' => '2',
            'address' =>
'B-14-4 Condo Hill,
South East Somewhere,
12121 Post Code,
Malaysia.',
            'phonenumber' => '0182847671',
            'homenumber' => '0389485858',
        ]);

        //15
        StudentProfile::create([
            'user_id' => '15',
            'id' => 'SW232425',
            'name' => 'Eleanor Binti Euzir',
            'email' => 'eleanor@gmail.com',
            'programme_id' => '2',
            'address' =>
'B-14-6 De Centrum Residence,
Jalan Sana,
43000 Kajang,
Selangor.',
            'phonenumber' => '0182847671',
            'homenumber' => '0389485858',
        ]);

        //16
        StudentProfile::create([
            'user_id' => '16',
            'id' => 'SW141516',
            'name' => 'Eka Farhana Binti Seventh',
            'email' => 'farhana@gmail.com',
            'programme_id' => '2',
            'address' =>
'14 Jalan Tun P,
Bandar Tun X,
32000 Subang X,
Selangor Darul Ehsan.',
            'phonenumber' => '0182847671',
            'homenumber' => '0389485858',
        ]);

        //17
        StudentProfile::create([
            'user_id' => '17',
            'id' => 'SW545454',
            'name' => 'Nicky Chan',
            'email' => 'nicky@gmail.com',
            'programme_id' => '2',
            'address' =>
'98 Jalan Tun Enggong,
Taman Ipoh Lama,
56700 Ipoh,
Perak.',
            'phonenumber' => '0182847671',
            'homenumber' => '0389485858',
        ]);

        //18
        StudentProfile::create([
            'user_id' => '18',
            'id' => 'SW337377',
            'name' => 'Peter James',
            'email' => 'peter@gmail.com',
            'programme_id' => '2',
            'address' =>
'3 Old Street,
Mexican Town,
New York.',
            'phonenumber' => '0182847671',
            'homenumber' => '0389485858',
        ]);
    }
}
