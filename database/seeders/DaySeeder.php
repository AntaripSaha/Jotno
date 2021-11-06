<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DaySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table("days")->insert([
            [
                "id" => 1,
                "name" => "Friday",
            ],
            [
                "id" => 2,
                "name" => "Saturday",
            ],
            [
                "id" => 3,
                "name" => "Sunday",
            ],
            [
                "id" => 4,
                "name" => "Monday",
            ],
            [
                "id" => 5,
                "name" => "Tuesday",
            ],
            [
                "id" => 6,
                "name" => "Wednesday",
            ],
            [
                "id" => 7,
                "name" => "Thursday",
            ],
        ]);
    }
}
