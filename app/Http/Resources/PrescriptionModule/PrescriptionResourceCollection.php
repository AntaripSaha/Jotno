<?php

namespace App\Http\Resources\PrescriptionModule;

use Illuminate\Http\Resources\Json\ResourceCollection;

class PrescriptionResourceCollection extends ResourceCollection
{
    public $collects = '\App\Http\Resources\PrescriptionModule\PrescriptionResource';
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return[
            'data' => $this->collection,
        ];
    }
}
