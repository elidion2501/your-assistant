<?php

namespace Database\Factories\TimeTrack;

use App\Models\Model;
use App\Models\TimeTrack\TimeTrack;
use App\Models\TimeTrack\TimeTrackType;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class TimeTrackFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = TimeTrack::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'user_id' => User::inRandomOrder()->first()->id,
            'description' => $this->faker->realText(rand(100, 250)),
            'time_from' =>  $this->faker->dateTimeBetween('- 1 months', '-15 days'),
            'time_to' =>  $this->faker->dateTimeBetween('- 14 days', '-1 days'),
            'time_track_type_id' => TimeTrackType::inRandomOrder()->first()->id,
        ];
    }
}
