<?php

namespace Database\Factories\MoneyTrack;

use App\Models\MoneyTrack\MoneyTrack;
use App\Models\MoneyTrack\MoneyTrackActionType;
use App\Models\MoneyTrack\MoneyTrackType;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class MoneyTrackFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = MoneyTrack::class;

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
            'title' => $this->faker->realText(rand(15, 25)),
            'money_track_type_id' => MoneyTrackType::inRandomOrder()->first()->id,
            'money_track_action_type_id' => MoneyTrackActionType::inRandomOrder()->first()->id,
            'money' => rand(50, 999),
        ];
    }
}
