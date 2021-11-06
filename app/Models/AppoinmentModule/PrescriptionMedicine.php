<?php

namespace App\Models\AppoinmentModule;

use App\Models\TestModule\Medicine;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PrescriptionMedicine extends Model
{
    use HasFactory;

    public function medicine(){
        return $this->belongsTo(Medicine::class);
    }

}
