<?php

namespace App\Models\AppoinmentModule;

use App\Models\TestModule\TestType;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PrescriptionTest extends Model
{
    use HasFactory;

    public function test_type(){
        return $this->belongsTo(TestType::class);
    }

}
