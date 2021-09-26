<?php

namespace App\Http\Resources\TimeTrack;

use Illuminate\Http\Resources\Json\JsonResource;

class UserForTimeTrackResource extends JsonResource
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
            'user_slug' => $this->slug,
            'user_name' => $this->nickname,
        ];
    }
}
