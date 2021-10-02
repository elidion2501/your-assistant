<?php

namespace App\Observers\MoneyTrack;

use App\Models\MoneyTrack\MoneyTrackActionType;
use App\Services\MainService;

class MoneyTrackActionTypeObserver
{
    /**
     * Handle the MoneyTrackActionType "creating" event.
     *
     * @param  \App\Models\MoneyTrackActionType  $moneyTrackActionType
     * @return void
     */
    public function creating(MoneyTrackActionType $moneyTrackActionType)
    {
        $mainService = new MainService;
        $moneyTrackActionType->slug = $mainService->createSlug($moneyTrackActionType->type_name, MoneyTrackActionType::class);
    }
    /**
     * Handle the MoneyTrackActionType "created" event.
     *
     * @param  \App\Models\MoneyTrackActionType  $moneyTrackActionType
     * @return void
     */
    public function created(MoneyTrackActionType $moneyTrackActionType)
    {
        //
    }

    /**
     * Handle the MoneyTrackActionType "updated" event.
     *
     * @param  \App\Models\MoneyTrackActionType  $moneyTrackActionType
     * @return void
     */
    public function updated(MoneyTrackActionType $moneyTrackActionType)
    {
        if ($moneyTrackActionType->isDirty('type_name')) {
            $mainService = new MainService;
            $moneyTrackActionType->slug = $mainService->createSlug($moneyTrackActionType->type_name, MoneyTrackActionType::class);
        }
    }

    /**
     * Handle the MoneyTrackActionType "deleted" event.
     *
     * @param  \App\Models\MoneyTrackActionType  $moneyTrackActionType
     * @return void
     */
    public function deleted(MoneyTrackActionType $moneyTrackActionType)
    {
        //
    }

    /**
     * Handle the MoneyTrackActionType "restored" event.
     *
     * @param  \App\Models\MoneyTrackActionType  $moneyTrackActionType
     * @return void
     */
    public function restored(MoneyTrackActionType $moneyTrackActionType)
    {
        //
    }

    /**
     * Handle the MoneyTrackActionType "force deleted" event.
     *
     * @param  \App\Models\MoneyTrackActionType  $moneyTrackActionType
     * @return void
     */
    public function forceDeleted(MoneyTrackActionType $moneyTrackActionType)
    {
        //
    }
}
