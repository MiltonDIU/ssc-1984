<?php

namespace Database\Seeders;

use App\Models\Address;
use App\Models\Batch;
use App\Models\Designation;
use App\Models\District;
use App\Models\Division;
use App\Models\FieldOfWork;
use App\Models\Organization;
use App\Models\School;
use App\Models\Union;
use App\Models\Upazila;
use App\Models\User;
use App\Models\Work;
use Carbon\Carbon;
use Faker\Factory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use function Symfony\Component\Translation\t;

class UsersTable2Seeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Factory::create();
        $divisions_id = $faker->randomElement(Division::all()->pluck('id')->toArray());
        $district_id = $faker->randomElement(District::where('division_id',$divisions_id)->get()->pluck('id')->toArray());
        $upazila_id = $faker->randomElement(Upazila::where('district_id',$district_id)->get()->pluck('id')->toArray());
        $school_id = $faker->randomElement(School::all()->pluck('id')->toArray());


        for ($i = 1; $i < 500; $i++) {
            $bd_user = User::all();
            $dis_user = User::where('district_id',$district_id)->get();

            $user = [
                'name'               => $faker->name,
                'email'              => $faker->companyEmail,
                'mobile'             => $faker->unique()->phoneNumber,
                'telephone_number'   => $faker->unique()->phoneNumber,
                'gender'             => $faker->randomElement(['Male','Female']),
                'date_of_birth'      => $faker->date('d-m-Y'),
                'blood_group'        => $faker->bloodGroup(),
                'password'           => bcrypt('password'),
                'remember_token'     => null,
                'approved'           => 1,
                'verified'           => 1,
                'verified_at'        => '2022-08-02 04:35:32',
                'verification_token' => '',
                'division_id'           => $divisions_id,
                'district_id'           => $district_id,
                'upazila_id'           => $upazila_id,
                'school_id'          => $school_id,
                'id_ssc_bd'          =>  count($bd_user)+1,
                'id_ssc_district'    => count($dis_user)+1,
            ];
            $user = User::create($user);
            $this->address($user);
            $user->roles()->sync(2);
        }
    }

    public function address($user){
        $faker = Factory::create();
        $division_id = $faker->randomElement(Division::all()->pluck('id')->toArray());
        $district_id = $faker->randomElement(District::where('division_id',$division_id)->get()->pluck('id')->toArray());
        $upazila_id = $faker->randomElement(Upazila::where('district_id',$district_id)->get()->pluck('id')->toArray());
        $addresses = [
            [
                'area'               => $faker->address,
                'type_of_address'    => 'Present',
                'division_id' => $division_id,
                'district_id' => $district_id,
                'upazila_id' => $upazila_id,
                'created_by_id' => $user->id,
            ],
        ];
        Address::insert($addresses);

    }
}
