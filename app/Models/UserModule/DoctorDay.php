<?php

namespace App\Models\UserModule;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DoctorDay extends Model
{
    use HasFactory;

    public function day(){
        return $this->belongsTo(Day::class);
    }

}
