<?php

namespace App\Http\Resources\UserModule;

use Illuminate\Http\Resources\Json\ResourceCollection;

class PatientResourceCollection extends ResourceCollection
{
    public $collects = '\App\Http\Resources\UserModule\PatientResource';
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
