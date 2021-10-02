<?php

namespace App\Observers\MoneyTrack;

use App\Models\MoneyTrack\MoneyTrack;
use App\Services\MainService;

class MoneyTrackObserver
{

    /**
     * Handle the TimeTrack "creating" event.
     *
     * @param  \App\Models\TimeTrack  $timeTrack
     * @return void
     */
    public function creating(MoneyTrack $moneyTrack)
    {
        $mainService = new MainService;
        $moneyTrack->slug = $mainService->createSlug($moneyTrack->title, MoneyTrack::class);
    }
    /**
     * Handle the MoneyTrack "created" event.
     *
     * @param  \App\Models\MoneyTrack  $moneyTrack
     * @return void
     */
    public function created(MoneyTrack $moneyTrack)
    {
        //
    }

    /**
     * Handle the MoneyTrack "updated" event.
     *
     * @param  \App\Models\MoneyTrack  $moneyTrack
     * @return void
     */
    public function updated(MoneyTrack $moneyTrack)
    {
        if ($moneyTrack->isDirty('title')) {
            $mainService = new MainService;
            $moneyTrack->slug = $mainService->createSlug($moneyTrack->title, MoneyTrack::class);
        }
    }

    /**
     * Handle the MoneyTrack "deleted" event.
     *
     * @param  \App\Models\MoneyTrack  $moneyTrack
     * @return void
     */
    public function deleted(MoneyTrack $moneyTrack)
    {
        //
    }

    /**
     * Handle the MoneyTrack "restored" event.
     *
     * @param  \App\Models\MoneyTrack  $moneyTrack
     * @return void
     */
    public function restored(MoneyTrack $moneyTrack)
    {
        //
    }

    /**
     * Handle the MoneyTrack "force deleted" event.
     *
     * @param  \App\Models\MoneyTrack  $moneyTrack
     * @return void
     */
    public function forceDeleted(MoneyTrack $moneyTrack)
    {
        //
    }
}
