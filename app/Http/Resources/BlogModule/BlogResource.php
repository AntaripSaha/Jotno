<?php

namespace App\Http\Resources\BlogModule;

use Illuminate\Http\Resources\Json\JsonResource;

class BlogResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            "id" => $this->id,
            "title" => $this->title,
            "description" => $this->description,
            "slug" => $this->slug,
            "profile_image" => ($this->type == 'user') ? asset('images/profile/' . $this->user->image) : asset('images/profile/' . $this->super_admin->image),
            "image" => asset('images/blogs/' . $this->image),
            "created_by" => ($this->type == 'user') ? $this->user->name : $this->super_admin->name,
            "created_at" => $this->created_at->toDateString(),
            "type" => $this->type,
        ];
    }
}
