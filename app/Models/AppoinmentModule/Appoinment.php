<?php

namespace App\Models\AppoinmentModule;

use App\Models\AppoinmentModule\AppoinmentNote;
use App\Models\UserModule\Doctor;
use App\Models\UserModule\Patient;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Appoinment extends Model
{
    use HasFactory;

    public function patient(){
        return $this->belongsTo(Patient::class);
    }

    public function doctor(){
        return $this->belongsTo(Doctor::class);
    }

    public function note(){
        return $this->hasMany(AppoinmentNote::class);
    }

    public function prescription(){
        return $this->hasMany(Prescription::class);
    }

    public function initial_test(){
        return $this->hasMany(AppoinmentInitialTest::class);
    }

}
