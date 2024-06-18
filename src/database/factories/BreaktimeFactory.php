<?php

namespace Database\Factories;

use App\Models\Breaktime;
use Illuminate\Database\Eloquent\Factories\Factory;

class BreaktimeFactory extends Factory
{
    protected $model = \App\Models\Breaktime::class;
    /**
     * Define the model's default state.
     *
     * @return array
     */

    public function definition()
    {
        $startBreak = $this->faker->dateTimeThisMonth();
        $endBreak = (clone $startBreak)->modify('+' . $this->faker->numberBetween(10, 120) . ' minutes');

        return [
            'start_break' => $startBreak,
            'end_break' => $endBreak,
        ];
    }

}
