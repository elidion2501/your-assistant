<?php

namespace App\Http\Resources\TimeTrackType;

use Illuminate\Http\Resources\Json\ResourceCollection;

class TimeTrackTypeCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {

        return TimeTrackTypeResource::collection($this->collection);
    }
}
