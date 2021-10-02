<?php

namespace Database\Factories\MoneyTrack;

use App\Models\MoneyTrack\MoneyTrackType;
use Illuminate\Database\Eloquent\Factories\Factory;

class MoneyTrackTypeFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = MoneyTrackType::class;

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
