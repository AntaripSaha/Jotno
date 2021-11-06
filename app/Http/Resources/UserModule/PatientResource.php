<?php

namespace App\Http\Resources\UserModule;

use Illuminate\Http\Resources\Json\JsonResource;

class PatientResource extends JsonResource
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
            'patient_id ' => $this->patient_id,
            'name ' => $this->name,
            'email ' => $this->email,
            'phone ' => $this->phone,
            'date_of_birth ' => $this->date_of_birth,
            'blood_group ' => $this->blood_group,
            'gender ' => $this->gender,
            'address ' => $this->address,
            'city ' => $this->city,
            'district ' => $this->district,
            'image ' => asset('images/profile/patient/'.$this->image),
            'is_active' => $this->is_active,
        ];
    }
}
