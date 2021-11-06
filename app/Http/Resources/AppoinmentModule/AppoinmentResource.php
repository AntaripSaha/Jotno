<?php

namespace App\Http\Resources\AppoinmentModule;

use Illuminate\Http\Resources\Json\JsonResource;

class AppoinmentResource extends JsonResource
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
            'appoinment_no' => $this->appoinment_no,
            'appoinment_date' => $this->appoinment_date,
            'total' => $this->total,
            'status' => $this->status,
            'payment_status' => $this->payment_status,
            'patient' => $this->patient,
            'doctor' => new DoctorResource($this->doctor) ,
            'prescription_id' => ( $this->prescription->count() > 0 ) ? $this->prescription[0]->id : null ,
            'initial_tests' => new InitialTestResourceCollection($this->initial_test),
        ];
    }
}
