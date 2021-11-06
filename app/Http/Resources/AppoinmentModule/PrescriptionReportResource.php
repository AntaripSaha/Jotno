<?php

namespace App\Http\Resources\AppoinmentModule;

use Illuminate\Http\Resources\Json\JsonResource;

class PrescriptionReportResource extends JsonResource
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
            'image' => asset('images/report/'.$this->image),
            'name' => $this->name,
            'date' => $this->created_at->toDateString(),
            'prescription_no' => $this->prescription->prescription_no
        ];
    }
}
