<?php

namespace Database\Factories;

use App\Models\Event;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Event>
 */
class EventFactory extends Factory
{
    protected $model = Event::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            "name" => $this->faker->sentence(3),
            "description" => $this->faker->paragraphs(2, true),
            "event_date" => $this->faker->unique()->dateTimeThisYear("+6 months"),
            "seats" => $this->faker->randomNumber(3, true)
        ];
    }
}
