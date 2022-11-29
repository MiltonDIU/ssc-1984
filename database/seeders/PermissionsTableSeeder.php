<?php

namespace Database\Seeders;

use App\Models\Permission;
use Illuminate\Database\Seeder;

class PermissionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $permissions = [
//           [
//               'title' => 'user_management_access',
//           ],
//           [
//               'title' => 'permission_create',
//           ],
//           [
//               'title' => 'permission_edit',
//           ],
//           [
//               'title' => 'permission_show',
//           ],
//           [
//               'title' => 'permission_delete',
//           ],
//           [
//               'title' => 'permission_access',
//           ],
//           [
//               'title' => 'role_create',
//           ],
//           [
//               'title' => 'role_edit',
//           ],
//           [
//               'title' => 'role_show',
//           ],
//           [
//               'title' => 'role_delete',
//           ],
//           [
//               'title' => 'role_access',
//           ],
//           [
//               'title' => 'user_create',
//           ],
//           [
//               'title' => 'user_edit',
//           ],
//           [
//               'title' => 'user_show',
//           ],
//           [
//               'title' => 'user_delete',
//           ],
//           [
//               'title' => 'user_access',
//           ],
//           [
//               'title' => 'audit_log_show',
//           ],
//           [
//               'title' => 'audit_log_access',
//           ],
//           [
//               'title' => 'profile_password_edit',
//           ],
//           [
//               'title' => 'setting_edit',
//           ],
//           [
//               'title' => 'setting_access',
//           ],
//           [
//               'title' => 'division_create',
//           ],
//           [
//               'title' => 'division_edit',
//           ],
//           [
//               'title' => 'division_show',
//           ],
//           [
//               'title' => 'division_delete',
//           ],
//           [
//               'title' => 'division_access',
//           ],
//           [
//               'title' => 'district_create',
//           ],
//           [
//               'title' => 'district_edit',
//           ],
//           [
//               'title' => 'district_show',
//           ],
//           [
//               'title' => 'district_delete',
//           ],
//           [
//               'title' => 'district_access',
//           ],
//           [
//               'title' => 'upazila_create',
//           ],
//           [
//               'title' => 'upazila_edit',
//           ],
//           [
//               'title' => 'upazila_show',
//           ],
//           [
//               'title' => 'upazila_delete',
//           ],
//           [
//               'title' => 'upazila_access',
//           ],
//           [
//               'title' => 'school_create',
//           ],
//           [
//               'title' => 'school_edit',
//           ],
//           [
//               'title' => 'school_show',
//           ],
//           [
//               'title' => 'school_delete',
//           ],
//           [
//               'title' => 'school_access',
//           ],
//
//           [
//               'title' => 'address_create',
//           ],
//           [
//               'title' => 'address_edit',
//           ],
//           [
//               'title' => 'address_show',
//           ],
//           [
//               'title' => 'address_delete',
//           ],
//           [
//               'title' => 'address_access',
//           ],
//           [
//               'title' => 'event_category_create',
//           ],
//           [
//               'title' => 'event_category_edit',
//           ],
//           [
//               'title' => 'event_category_show',
//           ],
//           [
//               'title' => 'event_category_delete',
//           ],
//           [
//               'title' => 'event_category_access',
//           ],
//           [
//
//               'title' => 'event_create',
//           ],
//           [
//
//               'title' => 'event_edit',
//           ],
//           [
//               'title' => 'event_show',
//           ],
//           [
//               'title' => 'event_delete',
//           ],
//           [
//               'title' => 'event_access',
//           ],
//           [
//               'title' => 'profession_create',
//           ],
//           [
//               'title' => 'profession_edit',
//           ],
//           [
//               'title' => 'profession_show',
//           ],
//           [
//               'title' => 'profession_delete',
//           ],
//           [
//               'title' => 'profession_access',
//           ],
//
//            [
//                'title' => 'schools_tow_create',
//            ],
//            [
//                'title' => 'schools_tow_edit',
//            ],
//            [
//                'title' => 'schools_tow_show',
//            ],
//            [
//                'title' => 'schools_tow_delete',
//            ],
//            [
//                'title' => 'schools_tow_access',
//            ],
        //member permission
//            [
//                'title' => 'member_batch_mate_access',
//            ],
//            [
//                'title' => 'member_batch_mate_profile',
//            ],
//            [
//                'title' => 'member_dashboard',
//            ],
//            [
//                'title' => 'member_batch_mate_access',
//            ],
//            [
//                'title' => 'member_batch_mate_profile',
//            ],
//            [
//                'title' => 'member_schools',
//            ],
//            [
//                'title' => 'member_profile',
//            ],
//            [
//                'title' => 'member_events_confirm',
//            ],
//            [
//                'title' => 'member_reference_by',
//            ],
//            [
//                'title' => 'member_events_registration',
//            ],
//            [
//                'title' => 'member_events_details',
//            ],
//            [
//                'title' => 'member_events',
//            ],
//            [
//                'title' => 'member_school_profile',
//            ],
//            [
//                'title' => 'member_settings',
//            ],
            [
                'title' => 'member_new_user',
            ],
            [
                'title' => 'member_update_user',
            ],

        ];

        Permission::insert($permissions);
    }
}
