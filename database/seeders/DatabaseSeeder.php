<?php

namespace Database\Seeders;

use App\Enums\TicketPriority;
use App\Enums\TicketStatus;
use App\Models\Ticket;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Create Admin User
        $admin = User::factory()->create([
            'name' => 'Admin User',
            'email' => 'admin@example.com',
            'password' => bcrypt('password'),
            'is_admin' => true,
        ]);

        // Create Regular Users
        $user1 = User::factory()->create([
            'name' => 'John Doe',
            'email' => 'john@example.com',
            'password' => bcrypt('password'),
            'is_admin' => false,
        ]);

        $user2 = User::factory()->create([
            'name' => 'Jane Smith',
            'email' => 'jane@example.com',
            'password' => bcrypt('password'),
            'is_admin' => false,
        ]);

        // Create additional random users
        $additionalUsers = User::factory(5)->create();

        // Create Sample Tickets
        $this->createSampleTickets($user1, $user2, $additionalUsers->all(), $admin);
    }

    private function createSampleTickets(User $user1, User $user2, array $additionalUsers, User $admin): void
    {
        $allUsers = array_merge([$user1, $user2], $additionalUsers);

        $ticketData = [
            [
                'title' => 'Login page not loading',
                'category' => 'Bug',
                'priority' => TicketPriority::HIGH,
                'description' => 'When I try to access the login page, it shows a 500 error. This started happening after the last deployment.',
                'status' => TicketStatus::IN_PROGRESS,
                'due_date' => now()->addDays(2),
                'assignee_id' => $admin->id,
            ],
            [
                'title' => 'Add export to Excel feature',
                'category' => 'Feature Request',
                'priority' => TicketPriority::MEDIUM,
                'description' => 'Would be great to have an option to export reports to Excel format for easier data analysis.',
                'status' => TicketStatus::NEW,
                'due_date' => now()->addWeeks(2),
                'assignee_id' => null,
            ],
            [
                'title' => 'Password reset email not received',
                'category' => 'Support',
                'priority' => TicketPriority::HIGH,
                'description' => 'I requested a password reset but haven\'t received the email. Checked spam folder as well.',
                'status' => TicketStatus::NEW,
                'due_date' => now()->addDay(),
                'assignee_id' => null,
            ],
            [
                'title' => 'Dashboard loading very slow',
                'category' => 'Performance',
                'priority' => TicketPriority::MEDIUM,
                'description' => 'The dashboard takes more than 10 seconds to load. It used to be instant before.',
                'status' => TicketStatus::IN_PROGRESS,
                'due_date' => now()->addDays(5),
                'assignee_id' => $admin->id,
            ],
            [
                'title' => 'Update user profile picture',
                'category' => 'Feature Request',
                'priority' => TicketPriority::LOW,
                'description' => 'Allow users to upload and change their profile pictures from the settings page.',
                'status' => TicketStatus::NEW,
                'due_date' => now()->addWeeks(3),
                'assignee_id' => null,
            ],
            [
                'title' => 'Mobile app crashes on startup',
                'category' => 'Bug',
                'priority' => TicketPriority::HIGH,
                'description' => 'The mobile application crashes immediately after opening on Android 14 devices.',
                'status' => TicketStatus::NEW,
                'due_date' => now()->addDays(3),
                'assignee_id' => null,
            ],
            [
                'title' => 'Implement dark mode',
                'category' => 'Feature Request',
                'priority' => TicketPriority::LOW,
                'description' => 'Add a dark mode theme option for better user experience during night time usage.',
                'status' => TicketStatus::DONE,
                'due_date' => now()->subWeek(),
                'assignee_id' => $admin->id,
            ],
            [
                'title' => 'Fix typo in welcome email',
                'category' => 'Bug',
                'priority' => TicketPriority::LOW,
                'description' => 'There is a typo in the welcome email template: "Welcom" should be "Welcome".',
                'status' => TicketStatus::DONE,
                'due_date' => now()->subDays(3),
                'assignee_id' => $admin->id,
            ],
            [
                'title' => 'Add two-factor authentication',
                'category' => 'Security',
                'priority' => TicketPriority::HIGH,
                'description' => 'Implement 2FA for enhanced account security. Should support authenticator apps.',
                'status' => TicketStatus::NEW,
                'due_date' => now()->addWeeks(4),
                'assignee_id' => null,
            ],
            [
                'title' => 'Report generation takes too long',
                'category' => 'Performance',
                'priority' => TicketPriority::MEDIUM,
                'description' => 'Generating monthly reports takes over 5 minutes. Need to optimize the query performance.',
                'status' => TicketStatus::REJECTED,
                'due_date' => now()->subWeek(),
                'assignee_id' => $admin->id,
            ],
        ];

        foreach ($ticketData as $index => $data) {
            $user = $allUsers[$index % count($allUsers)];
            $user->tickets()->create($data);
        }
    }
}
