<?php

namespace App\Observers\TimeTrack;

use App\Models\TimeTrack\TimeTrackType;
use App\Services\MainService;
use Illuminate\Support\Str;

class TimeTrackTypeObserver
{
    /**
     * Handle the TimeTrackType "creating" event.
     *
     * @param  \App\Models\TimeTrackType  $timeTrackType
     * @return void
     */
    public function creating(TimeTrackType $timeTrackType)
    {
        $mainService = new MainService;
        $timeTrackType->slug = $mainService->createSlug($timeTrackType->type_name, TimeTrackType::class);
    }
    /**
     * Handle the TimeTrackType "created" event.
     *
     * @param  \App\Models\TimeTrackType  $timeTrackType
     * @return void
     */
    public function created(TimeTrackType $timeTrackType)
    {
        //
    }

    /**
     * Handle the TimeTrackType "updated" event.
     *
     * @param  \App\Models\TimeTrackType  $timeTrackType
     * @return void
     */
    public function updated(TimeTrackType $timeTrackType)
    {
        if ($timeTrackType->isDirty('type_name')) {
            $mainService = new MainService;
            $timeTrackType->slug = $mainService->createSlug($timeTrackType->type_name, TimeTrackType::class);
        }
    }

    /**
     * Handle the TimeTrackType "deleted" event.
     *
     * @param  \App\Models\TimeTrackType  $timeTrackType
     * @return void
     */
    public function deleted(TimeTrackType $timeTrackType)
    {
        //
    }

    /**
     * Handle the TimeTrackType "restored" event.
     *
     * @param  \App\Models\TimeTrackType  $timeTrackType
     * @return void
     */
    public function restored(TimeTrackType $timeTrackType)
    {
        //
    }

    /**
     * Handle the TimeTrackType "force deleted" event.
     *
     * @param  \App\Models\TimeTrackType  $timeTrackType
     * @return void
     */
    public function forceDeleted(TimeTrackType $timeTrackType)
    {
        //
    }
}
