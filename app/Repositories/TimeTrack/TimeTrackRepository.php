<?php

namespace App\Repositories\TimeTrack;

use App\Http\Resources\TimeTrack\TimeTrackCollection;
use App\Models\TimeTrack\TimeTrack;
use App\Services\MainService;

/**
 * Class TimeTrackRepository.
 */
class TimeTrackRepository
{
    public function getTimeTracksWithPaginate($user_id, $perPage, $orderBy, $ordering)
    {
        $timeTracks = TimeTrack::where('user_id', $user_id)
            ->with(['user:id,slug,nickname', 'timeTrackType:id,type_name,slug'])
            ->orderBy($orderBy, $ordering)
            ->paginate($perPage);

        return $timeTracks;
    }
}
