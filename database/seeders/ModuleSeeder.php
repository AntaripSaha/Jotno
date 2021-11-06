<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ModuleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::statement("DELETE FROM modules");
        DB::table('modules')->insert([
            [
                'id' => 1,
                'name' => 'User Module',
                'key' => 'user_module',
                'icon' => 'fas fa-users',
                'position' => 1,
                'route' => null
            ],
            [
                'id' => 2,
                'name' => 'Setting Module',
                'key' => 'settings',
                'icon' => 'fas fa-cog',
                'position' => 6,
                'route' => null,
            ],
            [
                'id' => 3,
                'name' => 'Test Module',
                'key' => 'test_module',
                'icon' => 'fas fa-vial',
                'position' => 2,
                'route' => null,
            ],
            [
                'id' => 4,
                'name' => 'Appointment Module',
                'key' => 'appointment',
                'icon' => 'far fa-calendar-check',
                'position' => 3,
                'route' => null,
            ],
            [
                'id' => 5,
                'name' => 'Apps Module',
                'key' => 'apps',
                'icon' => 'fas fa-mobile-alt',
                'position' => 4,
                'route' => null,
            ],
            [
                'id' => 6,
                'name' => 'Contact Module',
                'key' => 'all_messege',
                'icon' => 'far fa-address-book',
                'position' => 5,
                'route' => null,
            ],
            [
                'id' => 7,
                'name' => 'All Page Module',
                'key' => 'all_pages',
                'icon' => 'fas fa-file',
                'position' => 7,
                'route' => null,
            ],
            
        ]);
    }
}