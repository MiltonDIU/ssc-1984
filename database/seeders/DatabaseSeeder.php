<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {

        $this->call([
//            PermissionsTableSeeder::class,
//            RolesTableSeeder::class,
//            PermissionRoleTableSeeder::class,
//            SchoolsTableSeeder::class,
//            UsersTableSeeder::class,
//            RoleUserTableSeeder::class,
//            SettingTableSeeder::class,

            UsersTable2Seeder::class,
            //EventsTableSeeder::class
        ]);
    }
}