<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TimingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::statement("DELETE FROM timings");
        DB::table("timings")->insert([
            [
                "id" => 1,
                "value" => "0",
                "type" => "Morning",
                "group" => "Mark",
                "is_active" => true,
            ],
            [
                "id" => 2,
                "value" => "1",
                "type" => "Morning",
                "group" => "Mark",
                "is_active" => true,
            ],
            [
                "id" => 3,
                "value" => "2",
                "type" => "Morning",
                "group" => "Mark",
                "is_active" => true,
            ],
            [
                "id" => 4,
                "value" => "0",
                "type" => "Noon",
                "group" => "Mark",
                "is_active" => true,
            ],
            [
                "id" => 5,
                "value" => "1",
                "type" => "Noon",
                "group" => "Mark",
                "is_active" => true,
            ],
            [
                "id" => 6,
                "value" => "2",
                "type" => "Noon",
                "group" => "Mark",
                "is_active" => true,
            ],
            [
                "id" => 7,
                "value" => "0",
                "type" => "Night",
                "group" => "Mark",
                "is_active" => true,
            ],
            [
                "id" => 8,
                "value" => "1",
                "type" => "Night",
                "group" => "Mark",
                "is_active" => true,
            ],
            [
                "id" => 9,
                "value" => "2",
                "type" => "Night",
                "group" => "Mark",
                "is_active" => true,
            ],
            [
                "id" => 10,
                "value" => "Before Food",
                "type" => "Time",
                "group" => "Mark",
                "is_active" => true,
            ],
            [
                "id" => 11,
                "value" => "After Food",
                "type" => "Time",
                "group" => "Mark",
                "is_active" => true,
            ],
            [
                "id" => 12,
                "value" => "0",
                "type" => "Morning",
                "group" => "Drop",
                "is_active" => true,
            ],
            [
                "id" => 13,
                "value" => "1",
                "type" => "Morning",
                "group" => "Drop",
                "is_active" => true,
            ],
            [
                "id" => 14,
                "value" => "2",
                "type" => "Morning",
                "group" => "Drop",
                "is_active" => true,
            ],
            [
                "id" =>15,
                "value" => "0",
                "type" => "Noon",
                "group" => "Drop",
                "is_active" => true,
            ],
            [
                "id" => 16,
                "value" => "1",
                "type" => "Noon",
                "group" => "Drop",
                "is_active" => true,
            ],
            [
                "id" => 17,
                "value" => "2",
                "type" => "Noon",
                "group" => "Drop",
                "is_active" => true,
            ],
            [
                "id" => 18,
                "value" => "0",
                "type" => "Night",
                "group" => "Drop",
                "is_active" => true,
            ],
            [
                "id" => 19,
                "value" => "1",
                "type" => "Night",
                "group" => "Drop",
                "is_active" => true,
            ],
            [
                "id" => 20,
                "value" => "2",
                "type" => "Night",
                "group" => "Drop",
                "is_active" => true,
            ],
            [
                "id" => 21,
                "value" => "Before Food",
                "type" => "Time",
                "group" => "Drop",
                "is_active" => true,
            ],
            [
                "id" => 22,
                "value" => "After Food",
                "type" => "Time",
                "group" => "Drop",
                "is_active" => true,
            ],
            [
                "id" => 23,
                "value" => "1 Month",
                "type" => "Running",
                "group" => null,
                "is_active" => true,
            ],
            [
                "id" => 24,
                "value" => "2 Month",
                "type" => "Running",
                "group" => null,
                "is_active" => true,
            ],
            
        ]);
    }
}
