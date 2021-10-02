<?php

namespace Database\Seeders;

use App\Models\MoneyTrack\MoneyTrack;
use App\Models\MoneyTrack\MoneyTrackActionType;
use App\Models\MoneyTrack\MoneyTrackType;
use App\Models\TimeTrack\TimeTrack;
use App\Models\TimeTrack\TimeTrackType;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Artisan;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        Artisan::call('passport:install');
        TimeTrackType::factory(10)->create();
        MoneyTrackType::factory(10)->create();
        MoneyTrackActionType::factory(10)->create();
        User::factory(1)
            ->has(TimeTrack::factory()->count(55), 'timeTracks')
            ->has(MoneyTrack::factory()->count(55), 'moneyTracks')
            ->create();
        // TimeTrack::factory(10)->create();
    }
}
