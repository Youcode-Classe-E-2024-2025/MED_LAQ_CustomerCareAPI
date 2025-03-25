<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Ticket>
 */
class TicketFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id' => 1,
            'agent_id' => null,
            'title' => $this->faker->sentence,
            'content' => $this->faker->paragraph,
            'status' => 'open',
            'resolved_at' => null,
            'cancelled_at' => null,
        ];
    }
}
