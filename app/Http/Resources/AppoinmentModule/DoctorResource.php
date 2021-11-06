<?php

namespace App\Http\Resources\AppoinmentModule;

use Illuminate\Http\Resources\Json\JsonResource;

class DoctorResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => 1,
            'doctor_id' => $this->doctor_id,
            'name' => $this->name,
            'designation' => $this->designation,
            'chamber' => $this->chamber,
            'location' => $this->location,
            'phone' => $this->phone,
            'email' => $this->email,
            'in' => $this->in,
            'out' => $this->out,
            'days' => new DayResourceCollection($this->day)
        ];
    }
}
