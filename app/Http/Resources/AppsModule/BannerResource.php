<?php

namespace App\Http\Resources\AppsModule;

use Illuminate\Http\Resources\Json\JsonResource;

class BannerResource extends JsonResource
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
            'title' => $this->title,            
            'image' => asset('images/banners/'.$this->image),
            'position' => $this->position
        ];
    }
}
