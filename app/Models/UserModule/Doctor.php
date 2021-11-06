<?php

namespace App\Models\UserModule;

use App\Models\AppoinmentModule\Charge;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Doctor extends Authenticatable
{
    use HasFactory;

    public function day(){
        return $this->hasMany(DoctorDay::class);
    }

    public function charge(){
        return $this->belongsTo(Charge::class);
    }   

}
