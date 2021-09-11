<?php

namespace App\Observers;

use App\Models\TimeTrack\TimeTrack;
use App\Services\MainService;

class TimeTrackObserver
{
    /**
     * Handle the TimeTrack "creating" event.
     *
     * @param  \App\Models\TimeTrack  $timeTrack
     * @return void
     */
    public function creating(TimeTrack $timeTrack)
    {
        $mainService = new MainService;
        $timeTrack->slug = $mainService->createSlug($timeTrack->time_from, TimeTrack::class);
    }

    /**
     * Handle the TimeTrack "created" event.
     *
     * @param  \App\Models\TimeTrack  $timeTrack
     * @return void
     */
    public function created(TimeTrack $timeTrack)
    {

    }
    /**
     * Handle the TimeTrack "updated" event.
     *
     * @param  \App\Models\TimeTrack  $timeTrack
     * @return void
     */
    public function updated(TimeTrack $timeTrack)
    {
        if($timeTrack->isDirty('time_from')){
            $mainService = new MainService;
            $timeTrack->slug = $mainService->createSlug($timeTrack->time_from, TimeTrack::class);
        }
    }

    /**
     * Handle the TimeTrack "deleted" event.
     *
     * @param  \App\Models\TimeTrack  $timeTrack
     * @return void
     */
    public function deleted(TimeTrack $timeTrack)
    {
        //
    }

    /**
     * Handle the TimeTrack "restored" event.
     *
     * @param  \App\Models\TimeTrack  $timeTrack
     * @return void
     */
    public function restored(TimeTrack $timeTrack)
    {
        //
    }

    /**
     * Handle the TimeTrack "force deleted" event.
     *
     * @param  \App\Models\TimeTrack  $timeTrack
     * @return void
     */
    public function forceDeleted(TimeTrack $timeTrack)
    {
        //
    }
}
