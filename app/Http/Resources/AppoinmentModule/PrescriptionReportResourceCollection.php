<?php

namespace App\Http\Resources\AppoinmentModule;

use Illuminate\Http\Resources\Json\ResourceCollection;

class PrescriptionReportResourceCollection extends ResourceCollection
{
    public $collects = '\App\Http\Resources\AppoinmentModule\PrescriptionReportResource';
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return[
            'data' => $this->collection,
        ];
    }
}
