<?php

namespace App\Http\Resources\AppoinmentModule;

use Illuminate\Http\Resources\Json\ResourceCollection;

class InitialTestResourceCollection extends ResourceCollection
{
    public $collects = '\App\Http\Resources\AppoinmentModule\InitialTestResource';
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
