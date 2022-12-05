<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users = [
            [
                'name'               => 'admin',
                'email'              => 'admin@alumni.com',
                'mobile'             => "01674797580",
                'telephone_number'   => "01674797580",
                'gender'             => "Male",
                'date_of_birth'      => "1991-12-31",
                'blood_group'        => "B+",
                'password'           => bcrypt('password'),
                'remember_token'     => null,
                'approved'           => 1,
                'verified'           => 1,
                'verified_at'        => '2022-08-02 04:35:32',
                'verification_token' => '',
                'id_ssc_bd'          => '',
                'id_ssc_district'    => '',
                'division_id'    => '1',
                'district_id'    => '1',
                'upazila_id'    => '1',
                'school_id'    => '1',
            ],
            [
                'name'               => 'Alumni',
                'email'              => 'alumni@alumni.com',
                'mobile'             => "01674797580",
                'telephone_number'   => "01674797580",
                'gender'             => "Male",
                'date_of_birth'      => "1991-12-31",
                'blood_group'        => "B+",
                'password'           => bcrypt('password'),
                'remember_token'     => null,
                'approved'           => 1,
                'verified'           => 1,
                'verified_at'        => '2022-08-02 04:35:32',
                'verification_token' => '',
                'id_ssc_bd'          => '000002',
                'id_ssc_district'    => '00002',
                'division_id'    => '1',
                'district_id'    => '1',
                'upazila_id'    => '1',
                'school_id'    => '1',
            ],
        ];

        User::insert($users);
    }
}
