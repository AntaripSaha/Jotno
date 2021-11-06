<?php

namespace App\Models\AppoinmentModule;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PrescriptionReport extends Model
{
    use HasFactory;

    public function prescription(){
        return $this->belongsTo(Prescription::class);
    }

    public function patient(){
        return $this->belongsTo(Patient::class);
    }

}
