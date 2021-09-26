<?php

namespace App\Http\Resources\TimeTrackType;

use Illuminate\Http\Resources\Json\JsonResource;

class TimeTrackTypeResource extends JsonResource
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
            'id' => $this->id,
            'slug' => $this->slug,
            'type_name' => $this->type_name,
        ];
    }
}
