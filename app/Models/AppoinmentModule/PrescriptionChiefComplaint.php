<?php

namespace App\Models\AppoinmentModule;

use App\Models\TestModule\ChiefComplaint;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PrescriptionChiefComplaint extends Model
{
    use HasFactory;

    public function chief_complaint(){
        return $this->belongsTo(ChiefComplaint::class);
    }
}
