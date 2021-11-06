<?php

namespace App\Http\Resources\ServiceModule;

use Illuminate\Http\Resources\Json\ResourceCollection;

class ServiceResourceCollection extends ResourceCollection
{
    public $collect ='App\Http\Resource\ServiceModule\ServiceResource';
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
