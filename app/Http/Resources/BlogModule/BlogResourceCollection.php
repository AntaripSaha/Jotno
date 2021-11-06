<?php

namespace App\Http\Resources\BlogModule;

use Illuminate\Http\Resources\Json\ResourceCollection;

class BlogResourceCollection extends ResourceCollection
{
    public $collects = '\App\Http\Resources\BlogModule\BlogResource';
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'data' => $this->collection,
        ];
    }
}
