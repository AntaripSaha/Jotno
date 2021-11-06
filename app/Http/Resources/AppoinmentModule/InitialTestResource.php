<?php

namespace App\Http\Resources\AppoinmentModule;

use Illuminate\Http\Resources\Json\JsonResource;

class InitialTestResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'name' => $this->initial_test->name,
            'value' => $this->value
        ];
    }
}
