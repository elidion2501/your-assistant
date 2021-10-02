<?php

namespace App\Http\Resources\MoneyTrack;

use Illuminate\Http\Resources\Json\ResourceCollection;

class MoneyTrackCollection extends ResourceCollection
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
            'data' => MoneyTrackResource::collection($this->collection),
        ];
    }
}
