<?php

namespace App\Http\Resources\AppoinmentModule;

use Illuminate\Http\Resources\Json\JsonResource;

class PrescriptionResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return[
            'id' => $this->id,
            'prescription_no' => $this->prescription_no , 
            'appoinment_no' => $this->appoinment->appoinment_no , 
            'advice' => $this->advice, 
            'doctor' => new DoctorResource($this->appoinment->doctor),
            'patient' => $this->appoinment->patient,
            'total' => $this->appoinment->total,
            'charge' => $this->appoinment->doctor->charge->amount,
            'payment_status' => $this->appoinment->payment_status,
            'created_at' => $this->created_at->toDateString(),
        ];
    }
}
