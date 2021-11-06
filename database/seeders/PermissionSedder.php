<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PermissionSedder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::statement("DELETE FROM permissions");

        DB::table('permissions')->insert([
            [
                'id' => 1,
                'key' => 'user_module',
                'display_name' => 'User Module',
                'module_id' => 1,
            ],
            [
                'id' => 2,
                'key' => 'all_user',
                'display_name' => 'All User',
                'module_id' => 1,
            ],
            [
                'id' => 3,
                'key' => 'add_user',
                'display_name' => '-- Add User',
                'module_id' => 1,
            ],
            [
                'id' => 4,
                'key' => 'edit_user',
                'display_name' => '-- Edit User',
                'module_id' => 1,
            ],
            [
                'id' => 5,
                'key' => 'reset_password',
                'display_name' => '-- Reset Password',
                'module_id' => 1,
            ],
            // patient start
            [
                'id' => 27,
                'key' => 'patient',
                'display_name' => 'All Patient',
                'module_id' => 1,
            ],
            [
                'id' => 28,
                'key' => 'edit_patient',
                'display_name' => '-- Edit Patient',
                'module_id' => 1,
            ],
            //patient end
            [
                'id' => 6,
                'key' => 'settings',
                'display_name' => 'Setting Module',
                'module_id' => 2,
            ],
            [
                'id' => 7,
                'key' => 'app_info',
                'display_name' => '-- App Info',
                'module_id' => 2,
            ],
            [
                'id' => 8,
                'key' => 'test_module',
                'display_name' => 'Test Module',
                'module_id' => 3,
            ],
            [
                'id' => 9,
                'key' => 'all_test',
                'display_name' => 'All Test',
                'module_id' => 3,
            ],
            [
                'id' => 10,
                'key' => 'add_test',
                'display_name' => '-- Add Test',
                'module_id' => 3,
            ],
            [
                'id' => 11,
                'key' => 'edit_test',
                'display_name' => '-- Edit Test',
                'module_id' => 3,
            ],
            [
                'id' => 12,
                'key' => 'doctor',
                'display_name' => 'Doctor',
                'module_id' => 1,
            ],
            [
                'id' => 13,
                'key' => 'add_doctor',
                'display_name' => '-- Add Doctor',
                'module_id' => 1,
            ],
            [
                'id' => 14,
                'key' => 'edit_doctor',
                'display_name' => '-- Edit Doctor',
                'module_id' => 1,
            ],
            [
                'id' => 15,
                'key' => 'doctor_reset_password',
                'display_name' => '-- Reset Password',
                'module_id' => 1,
            ],
            [
                'id' => 16,
                'key' => 'view_doctor',
                'display_name' => '-- View Doctor',
                'module_id' => 1,
            ],
            [
                'id' => 17,
                'key' => 'medical_assistant',
                'display_name' => 'Medical Assistant',
                'module_id' => 1,
            ],
            [
                'id' => 18,
                'key' => 'add_medical_assistant',
                'display_name' => '-- Add Assistant',
                'module_id' => 1,
            ],
            [
                'id' => 19,
                'key' => 'edit_medical_assistant',
                'display_name' => '-- Edit Assistant',
                'module_id' => 1,
            ],
            [
                'id' => 20,
                'key' => 'medical_assistant_reset_password',
                'display_name' => '-- Reset Password',
                'module_id' => 1,
            ],

            [
                'id' => 21,
                'key' => 'medicine',
                'display_name' => 'All Medicine',
                'module_id' => 3,
            ],
            [
                'id' => 22,
                'key' => 'add_medicine',
                'display_name' => '-- Add Medicine',
                'module_id' => 3,
            ],
            [
                'id' => 23,
                'key' => 'edit_medicine',
                'display_name' => '-- Edit Medicine',
                'module_id' => 3,
            ],
            [
                'id' => 24,
                'key' => 'initial_test',
                'display_name' => 'All Initial Test',
                'module_id' => 3,
            ],
            [
                'id' => 25,
                'key' => 'add_initial_test',
                'display_name' => '-- Add Initial Test',
                'module_id' => 3,
            ],
            [
                'id' => 26,
                'key' => 'edit_initial_test',
                'display_name' => '-- Edit Initial Test',
                'module_id' => 3,
            ],
            [
                'id' => 29,
                'key' => 'patient_reset_password',
                'display_name' => '-- Reset Password',
                'module_id' => 1,
            ],
            [
                'id' => 30,
                'key' => 'appointment',
                'display_name' => 'Appointment Module',
                'module_id' => 4,
            ],
            [
                'id' => 31,
                'key' => 'all_appointment',
                'display_name' => '-- All Appointment',
                'module_id' => 4,
            ],
            [
                'id' => 32,
                'key' => 'apps',
                'display_name' => 'App Module',
                'module_id' => 5,
            ],
            [
                'id' => 33,
                'key' => 'all_banner',
                'display_name' => 'All Banner',
                'module_id' => 5,
            ],
            [
                'id' => 34,
                'key' => 'add_banner',
                'display_name' => '-- Add Banner',
                'module_id' => 5,
            ],
            [
                'id' => 35,
                'key' => 'edit_banner',
                'display_name' => '-- Edit Banner',
                'module_id' => 5,
            ],
            [
                'id' => 36,
                'key' => 'delete_banner',
                'display_name' => '-- Delete Banner',
                'module_id' => 5,
            ],
            [
                'id' => 37,
                'key' => 'all_messege',
                'display_name' => 'All Messege',
                'module_id' => 6,
            ],
            [
                'id' => 38,
                'key' => 'reply_messege',
                'display_name' => '-- Reply Messege',
                'module_id' => 6,
            ],
            [
                'id' => 39,
                'key' => 'delete_messege',
                'display_name' => '-- Delete Messege',
                'module_id' => 6,
            ],
            [
                'id' => 40,
                'key' => 'all_charge',
                'display_name' => 'All Charge',
                'module_id' => 4,
            ],
            [
                'id' => 41,
                'key' => 'add_charge',
                'display_name' => '-- Add Charge',
                'module_id' => 4,
            ],
            [
                'id' => 42,
                'key' => 'edit_charge',
                'display_name' => '-- Edit Charge',
                'module_id' => 4,
            ],
            [
                'id' => 43,
                'key' => 'all_pages',
                'display_name' => 'All Page',
                'module_id' => 7,
            ],
            [
                'id' => 44,
                'key' => 'home_page',
                'display_name' => '-- Home Page',
                'module_id' => 7,
            ],
            [
                'id' => 45,
                'key' => 'quality_page',
                'display_name' => '-- Quality Page',
                'module_id' => 7,
            ],
            [
                'id' => 46,
                'key' => 'new_page',
                'display_name' => '-- Create New Page',
                'module_id' => 7,
            ],

            [
                'id' => 52,
                'key' => 'service_page',
                'display_name' => '-- Create Service',
                'module_id' => 7,
            ],
            
            //app module end

            // blog post start
            [
                'id' => 47,
                'key' => 'all_blog',
                'display_name' => 'All Blog',
                'module_id' => 7,
            ],
            [
                'id' => 48,
                'key' => 'view_blog',
                'display_name' => '-- View Blog',
                'module_id' => 7,
            ],
            [
                'id' => 49,
                'key' => 'add_blog',
                'display_name' => '-- Add Blog',
                'module_id' => 7,
            ],
            [
                'id' => 50,
                'key' => 'edit_blog',
                'display_name' => '-- Edit Blog',
                'module_id' => 7,
            ],
            [
                'id' => 51,
                'key' => 'delete_blog',
                'display_name' => '-- Delete Blog',
                'module_id' => 7,
            ],
            [
                'id' => 53,
                'key' => 'all_chief_complaints',
                'display_name' => 'All Chief Complaints',
                'module_id' => 3,
            ],
            [
                'id' => 54,
                'key' => 'add_chief_complaints',
                'display_name' => '-- Add Chief Complaints',
                'module_id' => 3,
            ],
            [
                'id' => 55,
                'key' => 'edit_chief_complaints',
                'display_name' => '-- Edit Chief Complaints',
                'module_id' => 3,
            ]
            // blog post end
        ]);
        
        //last id 52
    }
}
