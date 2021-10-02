<?php

namespace App\Observers\MoneyTrack;

use App\Models\MoneyTrack\MoneyTrackType;
use App\Services\MainService;

class MoneyTrackTypeObserver
{
    /**
     * Handle the MoneyTrackType "creating" event.
     *
     * @param  \App\Models\MoneyTrackType  $moneyTrackType
     * @return void
     */
    public function creating(MoneyTrackType $moneyTrackType)
    {
        $mainService = new MainService;
        $moneyTrackType->slug = $mainService->createSlug($moneyTrackType->type_name, MoneyTrackType::class);
    }
    /**
     * Handle the MoneyTrackType "created" event.
     *
     * @param  \App\Models\MoneyTrackType  $moneyTrackType
     * @return void
     */
    public function created(MoneyTrackType $moneyTrackType)
    {
    }

    /**
     * Handle the MoneyTrackType "updated" event.
     *
     * @param  \App\Models\MoneyTrackType  $moneyTrackType
     * @return void
     */
    public function updated(MoneyTrackType $moneyTrackType)
    {
        if ($moneyTrackType->isDirty('type_name')) {
            $mainService = new MainService;
            $moneyTrackType->slug = $mainService->createSlug($moneyTrackType->type_name, MoneyTrackType::class);
        }
    }

    /**
     * Handle the MoneyTrackType "deleted" event.
     *
     * @param  \App\Models\MoneyTrackType  $moneyTrackType
     * @return void
     */
    public function deleted(MoneyTrackType $moneyTrackType)
    {
        //
    }

    /**
     * Handle the MoneyTrackType "restored" event.
     *
     * @param  \App\Models\MoneyTrackType  $moneyTrackType
     * @return void
     */
    public function restored(MoneyTrackType $moneyTrackType)
    {
        //
    }

    /**
     * Handle the MoneyTrackType "force deleted" event.
     *
     * @param  \App\Models\MoneyTrackType  $moneyTrackType
     * @return void
     */
    public function forceDeleted(MoneyTrackType $moneyTrackType)
    {
        //
    }
}
