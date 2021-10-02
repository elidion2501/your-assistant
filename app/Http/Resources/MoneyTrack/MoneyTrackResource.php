<?php

namespace App\Http\Resources\MoneyTrack;

use Illuminate\Http\Resources\Json\JsonResource;

class MoneyTrackResource extends JsonResource
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
            'title' => $this->title,
            'slug'  => $this->slug,
            'description'  => $this->description,
            'user_id' => $this->user_id,
            'user_slug' => $this->whenLoaded('user', function () {
                return $this->user->slug;
            }),
            'user_name' => $this->whenLoaded('user', function () {
                return $this->user->nickname;
            }),
            'money_track_type_id' => $this->money_track_type_id,
            'money_track_type_name' => $this->whenLoaded('moneyTrackType', function () {
                return $this->moneyTrackType->type_name;
            }),
            'money_track_type_slug' => $this->whenLoaded('moneyTrackType', function () {
                return $this->moneyTrackType->slug;
            }),
            'money_track_action_type_id' => $this->money_track_action_type_id,
            'money_track_action_type_name' => $this->whenLoaded('moneyTrackActionType', function () {
                return $this->moneyTrackActionType->type_name;
            }),
            'money_track_action_type_slug' => $this->whenLoaded('moneyTrackActionType', function () {
                return $this->moneyTrackActionType->slug;
            }),

        ];
    }
}
