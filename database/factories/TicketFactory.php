<?php

namespace Database\Factories;

use App\Enums\TicketPriority;
use App\Enums\TicketStatus;
use App\Models\User;
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
            'title' => fake()->sentence(),
            'category' => fake()->randomElement(['Bug', 'Feature Request', 'Support', 'Performance', 'Security']),
            'priority' => fake()->randomElement(TicketPriority::cases()),
            'description' => fake()->paragraph(),
            'status' => fake()->randomElement(TicketStatus::cases()),
            'due_date' => fake()->optional()->dateTimeBetween('now', '+30 days'),
            'user_id' => User::factory(),
            'assignee_id' => null,
        ];
    }
}
