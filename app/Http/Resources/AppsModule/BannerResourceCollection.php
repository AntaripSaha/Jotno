<?php

namespace App\Http\Resources\AppsModule;

use Illuminate\Http\Resources\Json\ResourceCollection;

class BannerResourceCollection extends ResourceCollection
{
    public $collects = '\App\Http\Resources\AppsModule\BannerResource';
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
