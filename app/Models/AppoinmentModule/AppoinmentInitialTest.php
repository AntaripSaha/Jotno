<?php

namespace App\Models\AppoinmentModule;

use App\Models\TestModule\InitialTest;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AppoinmentInitialTest extends Model
{
    use HasFactory;

    public function initial_test(){
        return $this->belongsTo(InitialTest::class);
    }

    public function appoinment(){
        return $this->belongsTo(Appoinment::class);
    }

}
