<?php

namespace Database\Seeders;

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
            $union_id = $faker->randomElement(Union::where('upazila_id',$upazila_id)->get()->pluck('id')->toArray());
            $school_id = $faker->randomElement(School::all()->pluck('id')->toArray());
            $user_id = $faker->randomElement(User::get()->pluck('id')->toArray());
            $event_category_id = $faker->randomElement(EventCategory::get()->pluck('id')->toArray());
            $event= [
                'name' => $faker->sentence,
                'address' => $faker->address,
                'summary' => $faker->paragraph(3),
                'details' => $faker->paragraph(10),
                'is_free' => '0',
                'price' => 5000,
                'event_status' => '1',
                'event_date' => $faker->date('d-m-Y'),
                'event_time' => $faker->time,
                'district_id' => $district_id,
                'upazila_id' => $upazila_id,
                'union_id' => $union_id,
                'event_category_id' => $event_category_id,
                'created_by_id' => $user_id,

            ];
            $event = Event::create($event);
            $event->schools()->sync($school_id);
            $this->eventUser($event);
    }

    public function eventUser($event){
        $usersIds = array();
        $faker = Factory::create();
        for ($i = 1; $i < 10; $i++) {
            $users =
                [
                    'name'               => $faker->name,
                    'email'              => $faker->unique()->email,
                    'password'           => bcrypt('password'),
                    'remember_token'     => null,
                    'mobile'             => $faker->unique()->phoneNumber,
                    'approved'           => 1,
                    'verified'           => 1,
                    'verified_at'        => '2022-08-02 04:35:32',
                    'verification_token' => '',        ];
            $user = User::insert($users);
            array_push($usersIds,$user->id);
        }
       $event->users()->sync($usersIds);
    }
}
