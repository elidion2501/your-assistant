<?php

namespace App\Repositories\TimeTrack;

use App\Models\TimeTrack\TimeTrack;
use App\Services\MainService;

/**
 * Class TimeTrackRepository.
 */
class TimeTrackRepository
{
    public function getTimeTracksWithPaginate($user_id, $perPage, $orderBy, $ordering)
    {
        $mainService = new MainService;
        $timeTracks = TimeTrack::where('user_id', $user_id)
        ->orderBy($orderBy, $ordering)
        ->paginate($perPage);

        $timeTracks = $mainService->generatePaginationFormat($timeTracks->toArray());

        return $timeTracks;
    }
}
