<?php

namespace App\Repositories\MoneyTrack;

use App\Models\MoneyTrack\MoneyTrack;

/**
 * Class MoneyTrackRepository.
 */
class MoneyTrackRepository
{
    public function getMoneyTracksWithPaginate($user_id, $perPage, $orderBy, $ordering)
    {
        $moneyTracks = MoneyTrack::where('user_id', $user_id)
            ->with([
                'user:id,slug,nickname',
                'moneyTrackType:id,type_name,slug',
                'moneyTrackActionType:id,type_name,slug',
            ])
            ->orderBy($orderBy, $ordering)
            ->paginate($perPage);

        return $moneyTracks;
    }
}
