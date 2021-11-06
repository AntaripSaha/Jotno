<?php

namespace App\Models\TestModule;

use App\Models\AppoinmentModule\PrescriptionTest;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TestType extends Model
{
    use HasFactory;

    public function test_type_list(){
        return $this->hasMany(TestTypeList::class);
    }

    public function prescription_test_type(){
        return $this->hasMany(PrescriptionTest::class);
    }

}
