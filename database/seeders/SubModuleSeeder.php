<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SubModuleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        DB::statement("DELETE FROM sub_modules");


        DB::table('sub_modules')->insert([


            //module id 1 start
            [
                'id' => 1,
                'name' => 'All User',
                'key' => 'all_user',
                'position' => 1,
                'route' => 'user.all',
                'module_id' => 1,
            ],
            [
                'id' => 2,
                'name' => 'Roles',
                'key' => 'roles',
                'position' => 2,
                'route' => 'role.all',
                'module_id' => 1,
            ],
            [
                'id' => 5,
                'name' => 'Doctor',
                'key' => 'doctor',
                'position' => 3,
                'route' => 'doctor.all',
                'module_id' => 1,
            ],
            [
                'id' => 6,
                'name' => 'Medical Assistant',
                'key' => 'medical_assistant',
                'position' => 4,
                'route' => 'medical_assistant.all',
                'module_id' => 1,
            ],
            [
                'id' => 9,
                'name' => 'All Patient',
                'key' => 'patient',
                'position' => 5,
                'route' => 'patient.all',
                'module_id' => 1,
            ],
            //module id 1 end


            //module id 2 start
            [
                'id' => 3,
                'name' => 'App Info',
                'key' => 'app_info',
                'position' => 1,
                'route' => 'app.info.all',
                'module_id' => 2,
            ],
            //module id 2 end


            //module id 3 start
            [
                'id' => 4,
                'name' => 'All Test',
                'key' => 'all_test',
                'position' => 1,
                'route' => 'test.all',
                'module_id' => 3,
            ],
            [
                'id' => 7,
                'name' => 'All Medicine',
                'key' => 'medicine',
                'position' => 2,
                'route' => 'medicine.all',
                'module_id' => 3,
            ],
            [
                'id' => 8,
                'name' => 'All Initial Test',
                'key' => 'all_initial_test',
                'position' => 3,
                'route' => 'initial_test.all',
                'module_id' => 3,
            ],
            //module id 3 end


            //module id 4 start
            [
                'id' => 10,
                'name' => 'All Appointment',
                'key' => 'all_appointment',
                'position' => 1,
                'route' => 'appointment.all',
                'module_id' => 4,
            ],
            [
                'id' => 11,
                'name' => 'All Charge',
                'key' => 'all_charge',
                'position' => 2,
                'route' => 'charge.all',
                'module_id' => 4,
            ],
            //module id 4 end


            //module id 5 start
            [
                'id' => 12,
                'name' => 'All Banner',
                'key' => 'all_banner',
                'position' => 1,
                'route' => 'banner.all',
                'module_id' => 5,
            ],
            //module id 5 end

            //module id 6 start
            [
                'id' => 13,
                'name' => 'All Messege',
                'key' => 'all_messege',
                'position' => 1,
                'route' => 'messege.all',
                'module_id' => 6,
            ],
            //module id 6 end


            //module id 7 start
            [
                'id' => 14,
                'name' => 'Home Page',
                'key' => 'home_page',
                'position' => 1,
                'route' => 'home.page',
                'module_id' => 7,
            ],
            [
                'id' => 15,
                'name' => 'Create New Page',
                'key' => 'new_page',
                'position' => 3,
                'route' => 'new.page',
                'module_id' => 7,
            ],
            [
                'id' => 16,
                'name' => 'Service Page',
                'key' => 'service_page',
                'position' => 2,
                'route' => 'all.service',
                'module_id' => 7,
            ],
            [
                'id' => 17,
                'name' => 'All Blog Page',
                'key' => 'all_blog',
                'position' => 4,
                'route' => 'blog.page',
                'module_id' => 7,
            ],
            
            //module id 7 end
            [
                'id' => 18,
                'name' => 'All Chief Complaints',
                'key' => 'all_chief_complaints',
                'position' => 4,
                'route' => 'chief.complaints.all',
                'module_id' => 3,
            ],

        ]);

        //last id 8
    }
}
