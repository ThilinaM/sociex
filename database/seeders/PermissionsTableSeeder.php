<?php

namespace Database\Seeders;

use App\Models\Permission;
use Illuminate\Database\Seeder;

class PermissionsTableSeeder extends Seeder
{
    public function run()
    {
        $permissions = [
            [
                'id'    => 1,
                'title' => 'user_management_access',
            ],
            [
                'id'    => 2,
                'title' => 'permission_create',
            ],
            [
                'id'    => 3,
                'title' => 'permission_edit',
            ],
            [
                'id'    => 4,
                'title' => 'permission_show',
            ],
            [
                'id'    => 5,
                'title' => 'permission_delete',
            ],
            [
                'id'    => 6,
                'title' => 'permission_access',
            ],
            [
                'id'    => 7,
                'title' => 'role_create',
            ],
            [
                'id'    => 8,
                'title' => 'role_edit',
            ],
            [
                'id'    => 9,
                'title' => 'role_show',
            ],
            [
                'id'    => 10,
                'title' => 'role_delete',
            ],
            [
                'id'    => 11,
                'title' => 'role_access',
            ],
            [
                'id'    => 12,
                'title' => 'user_create',
            ],
            [
                'id'    => 13,
                'title' => 'user_edit',
            ],
            [
                'id'    => 14,
                'title' => 'user_show',
            ],
            [
                'id'    => 15,
                'title' => 'user_delete',
            ],
            [
                'id'    => 16,
                'title' => 'user_access',
            ],
            [
                'id'    => 17,
                'title' => 'user_alert_create',
            ],
            [
                'id'    => 18,
                'title' => 'user_alert_show',
            ],
            [
                'id'    => 19,
                'title' => 'user_alert_delete',
            ],
            [
                'id'    => 20,
                'title' => 'user_alert_access',
            ],
            [
                'id'    => 21,
                'title' => 'faq_management_access',
            ],
            [
                'id'    => 22,
                'title' => 'faq_category_create',
            ],
            [
                'id'    => 23,
                'title' => 'faq_category_edit',
            ],
            [
                'id'    => 24,
                'title' => 'faq_category_show',
            ],
            [
                'id'    => 25,
                'title' => 'faq_category_delete',
            ],
            [
                'id'    => 26,
                'title' => 'faq_category_access',
            ],
            [
                'id'    => 27,
                'title' => 'faq_question_create',
            ],
            [
                'id'    => 28,
                'title' => 'faq_question_edit',
            ],
            [
                'id'    => 29,
                'title' => 'faq_question_show',
            ],
            [
                'id'    => 30,
                'title' => 'faq_question_delete',
            ],
            [
                'id'    => 31,
                'title' => 'faq_question_access',
            ],
            [
                'id'    => 32,
                'title' => 'sponsorship_tracking_create',
            ],
            [
                'id'    => 33,
                'title' => 'sponsorship_tracking_edit',
            ],
            [
                'id'    => 34,
                'title' => 'sponsorship_tracking_show',
            ],
            [
                'id'    => 35,
                'title' => 'sponsorship_tracking_delete',
            ],
            [
                'id'    => 36,
                'title' => 'sponsorship_tracking_access',
            ],
            [
                'id'    => 37,
                'title' => 'setting_access',
            ],
            [
                'id'    => 38,
                'title' => 'sponsorship_type_create',
            ],
            [
                'id'    => 39,
                'title' => 'sponsorship_type_edit',
            ],
            [
                'id'    => 40,
                'title' => 'sponsorship_type_show',
            ],
            [
                'id'    => 41,
                'title' => 'sponsorship_type_delete',
            ],
            [
                'id'    => 42,
                'title' => 'sponsorship_type_access',
            ],
            [
                'id'    => 43,
                'title' => 'event_type_create',
            ],
            [
                'id'    => 44,
                'title' => 'event_type_edit',
            ],
            [
                'id'    => 45,
                'title' => 'event_type_show',
            ],
            [
                'id'    => 46,
                'title' => 'event_type_delete',
            ],
            [
                'id'    => 47,
                'title' => 'event_type_access',
            ],
            [
                'id'    => 48,
                'title' => 'event_create',
            ],
            [
                'id'    => 49,
                'title' => 'event_edit',
            ],
            [
                'id'    => 50,
                'title' => 'event_show',
            ],
            [
                'id'    => 51,
                'title' => 'event_delete',
            ],
            [
                'id'    => 52,
                'title' => 'event_access',
            ],
            [
                'id'    => 53,
                'title' => 'event_registration_create',
            ],
            [
                'id'    => 54,
                'title' => 'event_registration_edit',
            ],
            [
                'id'    => 55,
                'title' => 'event_registration_show',
            ],
            [
                'id'    => 56,
                'title' => 'event_registration_delete',
            ],
            [
                'id'    => 57,
                'title' => 'event_registration_access',
            ],
            [
                'id'    => 58,
                'title' => 'event_attendance_create',
            ],
            [
                'id'    => 59,
                'title' => 'event_attendance_edit',
            ],
            [
                'id'    => 60,
                'title' => 'event_attendance_show',
            ],
            [
                'id'    => 61,
                'title' => 'event_attendance_delete',
            ],
            [
                'id'    => 62,
                'title' => 'event_attendance_access',
            ],
            [
                'id'    => 63,
                'title' => 'event_feedback_create',
            ],
            [
                'id'    => 64,
                'title' => 'event_feedback_edit',
            ],
            [
                'id'    => 65,
                'title' => 'event_feedback_show',
            ],
            [
                'id'    => 66,
                'title' => 'event_feedback_delete',
            ],
            [
                'id'    => 67,
                'title' => 'event_feedback_access',
            ],
            [
                'id'    => 68,
                'title' => 'event_setting_create',
            ],
            [
                'id'    => 69,
                'title' => 'event_setting_edit',
            ],
            [
                'id'    => 70,
                'title' => 'event_setting_show',
            ],
            [
                'id'    => 71,
                'title' => 'event_setting_delete',
            ],
            [
                'id'    => 72,
                'title' => 'event_setting_access',
            ],
            [
                'id'    => 73,
                'title' => 'profile_password_edit',
            ],
        ];

        Permission::insert($permissions);
    }
}
