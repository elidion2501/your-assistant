<?php

namespace App\Providers;

use App\Http\Controllers\Api\v1\Auth\AuthApiController;
use App\Models\TimeTrack\TimeTrack;
use App\Models\TimeTrack\TimeTrackType;
use App\Models\User;
use App\Observers\TimeTrackObserver;
use App\Observers\TimeTrackTypeObserver;
use App\Observers\UserObserver;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\ServiceProvider;
use Knuckles\Camel\Extraction\ExtractedEndpointData;
use Symfony\Component\HttpFoundation\Request;
use Knuckles\Scribe\Scribe;


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

        if (class_exists(\Knuckles\Scribe\Scribe::class)) {
            Scribe::beforeResponseCall(function (Request $request, ExtractedEndpointData $endpointData) {
                $token = User::first()->createToken('API Token')->accessToken;
                $request->headers->add(["Authorization" => "Bearer " .  $token]);
            });
        }


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
