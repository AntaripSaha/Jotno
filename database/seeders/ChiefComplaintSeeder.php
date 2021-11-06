<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ChiefComplaintSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table("chief_complaints")->insert([
            [
                'id' => 1,
                'name' => 'BURST FRACTURE L1 L2',
                'is_active' => true,
            ],
            [
                'id' => 2,
                'name' => 'BURST FRACTURE D12',
                'is_active' => true,
            ],
            [
                'id' => 3,
                'name' => 'BILATERAL CERVICAL HIP',
                'is_active' => true,
            ],
            [
                'id' => 4,
                'name' => 'BACK PAIN',
                'is_active' => true,
            ],
        ]);
    }
}
