<?php

namespace Database\Seeders;

use App\Models\Address;
use App\Models\District;
use App\Models\Division;
use App\Models\Event;
use App\Models\EventCategory;
use App\Models\School;
use App\Models\Upazila;
use App\Models\User;
use Faker\Factory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class EventsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Factory::create();
            $district_id = $faker->randomElement(District::get()->pluck('id')->toArray());
            $upazila_id = $faker->randomElement(Upazila::where('district_id',$district_id)->get()->pluck('id')->toArray());
            $school_id = $faker->randomElement(School::all()->pluck('id')->toArray());
            $user_id = $faker->randomElement(User::get()->pluck('id')->toArray());
            $event_category_id = $faker->randomElement(EventCategory::get()->pluck('id')->toArray());
            $event_name = $faker->sentence;
            $event= [
                'event_category_id' => $event_category_id,
                'name' => $event_name,
                'slug' => Str::slug($event_name),
                'details' => $faker->paragraph(20),
                'event_date' => $faker->date('d-m-Y'),
                'event_time' => $faker->time,
                'event_end_time' => $faker->time,
                'address' => $faker->address,
                'district_id' => $district_id,
                'is_free' => '0',
                'price' => 5000,
                'is_active' => '1',
            ];
            $event = Event::create($event);
            $this->newUser($event);
    }

   public function newUser($event){
       $faker = Factory::create();
       $divisions_id = $faker->randomElement(Division::all()->pluck('id')->toArray());
       $district_id = $faker->randomElement(District::where('division_id',$divisions_id)->get()->pluck('id')->toArray());
       $upazila_id = $faker->randomElement(Upazila::where('district_id',$district_id)->get()->pluck('id')->toArray());
       $school_id = $faker->randomElement(School::all()->pluck('id')->toArray());
       $usersIds = array();
       for ($i = 1; $i < 5000; $i++) {
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
           array_push($usersIds,$user->id);
           $this->address($user);
           $user->roles()->sync(2);
       }
       $event->users()->sync($usersIds);
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
                'user_id' => $user->id,
                'created_by_id' => $user->id,
            ],
        ];
        Address::insert($addresses);

    }



//
//
//    public function eventUser($event){
//        $usersIds = array();
//        $faker = Factory::create();
//        for ($i = 1; $i < 500; $i++) {
//            $users =
//                [
//                    'name'               => $faker->name,
//                    'email'              => $faker->unique()->email,
//                    'password'           => bcrypt('password'),
//                    'remember_token'     => null,
//                    'mobile'             => $faker->unique()->phoneNumber,
//                    'approved'           => 1,
//                    'verified'           => 1,
//                    'verified_at'        => '2022-08-02 04:35:32',
//                    'verification_token' => '',        ];
//            $user = User::insert($users);
//            array_push($usersIds,$user->id);
//        }
//       $event->users()->sync($usersIds);
//    }
}
