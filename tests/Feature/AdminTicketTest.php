<?php

namespace Tests\Feature;

use App\Enums\TicketStatus;
use App\Models\Ticket;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AdminTicketTest extends TestCase
{
    use RefreshDatabase;

    public function test_admin_can_access_admin_panel(): void
    {
        $admin = User::factory()->create(['is_admin' => true]);

        $response = $this->actingAs($admin)->get('/admin/tickets');

        $response->assertStatus(200);
        $response->assertSee('Admin Panel');
    }

    public function test_regular_user_cannot_access_admin_panel(): void
    {
        $user = User::factory()->create(['is_admin' => false]);

        $response = $this->actingAs($user)->get('/admin/tickets');

        $response->assertStatus(403);
    }

    public function test_admin_can_see_all_tickets(): void
    {
        $admin = User::factory()->create(['is_admin' => true]);
        $user1 = User::factory()->create();
        $user2 = User::factory()->create();

        $ticket1 = Ticket::factory()->create(['user_id' => $user1->id, 'title' => 'Ticket 1']);
        $ticket2 = Ticket::factory()->create(['user_id' => $user2->id, 'title' => 'Ticket 2']);

        $response = $this->actingAs($admin)->get('/admin/tickets');

        $response->assertSee('Ticket 1');
        $response->assertSee('Ticket 2');
    }

    public function test_admin_can_update_ticket_status(): void
    {
        $admin = User::factory()->create(['is_admin' => true]);
        $user = User::factory()->create();
        $ticket = Ticket::factory()->create([
            'user_id' => $user->id,
            'status' => TicketStatus::NEW,
        ]);

        $response = $this->actingAs($admin)->patch("/admin/tickets/{$ticket->id}/status", [
            'status' => TicketStatus::IN_PROGRESS->value,
        ]);

        $response->assertRedirect('/admin/tickets');
        $this->assertDatabaseHas('tickets', [
            'id' => $ticket->id,
            'status' => TicketStatus::IN_PROGRESS->value,
        ]);
    }

    public function test_regular_user_cannot_update_ticket_status(): void
    {
        $user = User::factory()->create(['is_admin' => false]);
        $ticket = Ticket::factory()->create(['user_id' => $user->id]);

        $response = $this->actingAs($user)->patch("/admin/tickets/{$ticket->id}/status", [
            'status' => TicketStatus::IN_PROGRESS->value,
        ]);

        $response->assertStatus(403);
    }

    public function test_admin_can_assign_ticket(): void
    {
        $admin = User::factory()->create(['is_admin' => true]);
        $assignee = User::factory()->create(['is_admin' => true]);
        $user = User::factory()->create();
        $ticket = Ticket::factory()->create([
            'user_id' => $user->id,
            'assignee_id' => null,
        ]);

        $response = $this->actingAs($admin)->patch("/admin/tickets/{$ticket->id}/assign", [
            'assignee_id' => $assignee->id,
        ]);

        $response->assertRedirect('/admin/tickets');
        $this->assertDatabaseHas('tickets', [
            'id' => $ticket->id,
            'assignee_id' => $assignee->id,
        ]);
    }

    public function test_admin_can_filter_tickets_by_status(): void
    {
        $admin = User::factory()->create(['is_admin' => true]);
        $user = User::factory()->create();

        $newTicket = Ticket::factory()->create([
            'user_id' => $user->id,
            'status' => TicketStatus::NEW,
            'title' => 'New Ticket',
        ]);

        $doneTicket = Ticket::factory()->create([
            'user_id' => $user->id,
            'status' => TicketStatus::DONE,
            'title' => 'Done Ticket',
        ]);

        $response = $this->actingAs($admin)->get('/admin/tickets?status=new');

        $response->assertSee('New Ticket');
        $response->assertDontSee('Done Ticket');
    }

    public function test_admin_can_search_tickets(): void
    {
        $admin = User::factory()->create(['is_admin' => true]);
        $user = User::factory()->create();

        $ticket1 = Ticket::factory()->create([
            'user_id' => $user->id,
            'title' => 'Database Connection Issue',
        ]);

        $ticket2 = Ticket::factory()->create([
            'user_id' => $user->id,
            'title' => 'UI Layout Problem',
        ]);

        $response = $this->actingAs($admin)->get('/admin/tickets?search=Database');

        $response->assertSee('Database Connection Issue');
        $response->assertDontSee('UI Layout Problem');
    }

    public function test_guest_cannot_access_admin_panel(): void
    {
        $response = $this->get('/admin/tickets');

        $response->assertRedirect('/login');
    }
}
