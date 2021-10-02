<?php

namespace Database\Factories\MoneyTrack;

use App\Models\MoneyTrack\MoneyTrackActionType;
use Illuminate\Database\Eloquent\Factories\Factory;

class MoneyTrackActionTypeFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = MoneyTrackActionType::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'type_name' => $this->faker->realText(rand(15, 25)),
        ];
    }
}
