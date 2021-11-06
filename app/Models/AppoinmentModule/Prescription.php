<?php

namespace App\Models\AppoinmentModule;

use App\Models\UserModule\Doctor;
use App\Models\UserModule\MedicalAssistant;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Prescription extends Model
{
    use HasFactory;
    
    public function medical_assistant(){
        return $this->belongsTo(MedicalAssistant::class,"created_by","id");
    }

    public function doctor(){
        return $this->belongsTo(Doctor::class,"created_by","id");
    }

    public function appoinment(){
        return $this->belongsTo(Appoinment::class);
    }

    public function prescription_medicine(){
        return $this->hasMany(PrescriptionMedicine::class);
    }


    public function prescription_test(){
        return $this->hasMany(PrescriptionTest::class);
    }

    public function chief_complaint(){
        return $this->hasMany(PrescriptionChiefComplaint::class);
    }


}
