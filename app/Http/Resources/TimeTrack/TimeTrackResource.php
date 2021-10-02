<?php

namespace App\Http\Resources\TimeTrack;

use Illuminate\Http\Resources\Json\JsonResource;

class TimeTrackResource extends JsonResource
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
            'description'  => $this->description,
            'time_from'  => $this->time_from,
            'time_to'  => $this->time_to,
            'slug'  => $this->slug,
            'user_slug' => $this->whenLoaded('user', function () {
                return $this->user->slug;
            }),
            'user_name' => $this->whenLoaded('user', function () {
                return $this->user->nickname;
            }),
            'time_track_type_id' => $this->whenLoaded('timeTrackType', function () {
                return $this->timeTrackType->id;
            }),
            'time_track_type_name' => $this->whenLoaded('timeTrackType', function () {
                return $this->timeTrackType->type_name;
            }),
            'time_track_type_slug' => $this->whenLoaded('timeTrackType', function () {
                return $this->timeTrackType->slug;
            }),

        ];
    }
}
