<?php

namespace App\Http\Resources\TimeTrack;

use App\Http\Resources\PaginationCollection;
use Illuminate\Http\Resources\Json\ResourceCollection;

class TimeTrackCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {

        return [
            'total' => $this->total(),
            'current_page' => $this->currentPage(),
            'data' => TimeTrackResource::collection($this->collection),
        ];
    }
}
