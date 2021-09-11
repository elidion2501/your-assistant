<?php

namespace Database\Factories\TimeTrack;

use App\Models\Model;
use App\Models\TimeTrack\TimeTrackType;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class TimeTrackTypeFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = TimeTrackType::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'type_name' => $this->faker->name(),
        ];
    }
}
