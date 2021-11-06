<?php

namespace App\Models\AppoinmentModule;

use App\Models\UserModule\Doctor;
use App\Models\UserModule\MedicalAssistant;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AppoinmentNote extends Model
{
    use HasFactory;

    public function doctor(){
        return $this->belongsTo(Doctor::class,"created_by","id");
    }

    public function medical_assistant(){
        return $this->belongsTo(MedicalAssistant::class,"created_by","id");
    }

}
