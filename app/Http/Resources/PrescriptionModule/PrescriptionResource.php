<?php

namespace App\Http\Resources\PrescriptionModule;

use App\Models\AppoinmentModule\Appoinment;
use Illuminate\Http\Resources\Json\JsonResource;

class PrescriptionResource extends JsonResource
{
    
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request) 
    {
        return[
            'id' => $this->id,
            'prescription_no' => $this->prescription_no,
            'appoinment_no' => $this->appoinment->appoinment_no,
            'created_at' => $this->created_at->toDateString(),
            'doctor_name' => $this->appoinment->doctor->name,
            'total' => $this->appoinment->total,
            'charge' => $this->appoinment->doctor->charge->amount,
            'advice' => $this->advice,
        ];
    }
}
