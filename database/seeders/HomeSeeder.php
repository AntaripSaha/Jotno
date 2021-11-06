<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class HomeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::statement("DELETE FROM homes");
        DB::table("homes")->insert([
            [
                "id" => 1,                
                'title' => 'Find The Best',
                'sub_title' => 'We are always ready to give you medical home service, Contact now to get any of your medical services at you home.',
                'description' => 'We are always ready',
                "image" => "image.png",
                "about_title" => "Find The Best",
                "about_description" => "We are always ready to give you medical home service,",
                "about_image" => "image.png",
                "satisfied_patient" => "1200",
                "patient_per_year" => "100",
            ]
        ]);
    }
}
