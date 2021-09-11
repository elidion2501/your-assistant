<?php

namespace App\Providers;

use App\Models\TimeTrack\TimeTrack;
use App\Models\TimeTrack\TimeTrackType;
use App\Models\User;
use App\Observers\TimeTrackObserver;
use App\Observers\TimeTrackTypeObserver;
use App\Observers\UserObserver;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Response::macro('success', function ($data) {
            return response()->json([
                'code' => "200",
                'data' => $data,
            ]);
        });
        Response::macro('error', function ($error, $status_code) {
            return response()->json([
                'code' => $status_code,
                'errors' => $error,
            ]);
        });

        
        User::observe(UserObserver::class);
        TimeTrackType::observe(TimeTrackTypeObserver::class);
        TimeTrack::observe(TimeTrackObserver::class);
        
    }
}
