<?php

namespace Tests\Feature;

use App\Enums\TicketPriority;
use App\Enums\TicketStatus;
use App\Models\Ticket;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class TicketTest extends TestCase
{
    use RefreshDatabase;

    public function test_user_can_view_dashboard(): void
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)->get('/dashboard');

        $response->assertStatus(200);
        $response->assertSee('My Tickets');
    }

    public function test_user_can_create_ticket(): void
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)->post('/tickets', [
            'title' => 'Test Ticket',
            'category' => 'Bug',
            'priority' => 'high',
            'description' => 'This is a test ticket description.',
            'due_date' => now()->addDays(5)->format('Y-m-d'),
        ]);

        $response->assertRedirect('/dashboard');
        $response->assertSessionHas('success');

        $this->assertDatabaseHas('tickets', [
            'title' => 'Test Ticket',
            'user_id' => $user->id,
            'status' => TicketStatus::NEW->value,
        ]);
    }

    public function test_ticket_creation_requires_title(): void
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)->post('/tickets', [
            'priority' => 'high',
            'description' => 'This is a test ticket description.',
        ]);

        $response->assertSessionHasErrors('title');
    }

    public function test_ticket_creation_requires_description(): void
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)->post('/tickets', [
            'title' => 'Test Ticket',
            'priority' => 'high',
        ]);

        $response->assertSessionHasErrors('description');
    }

    public function test_user_can_view_own_ticket(): void
    {
        $user = User::factory()->create();
        $ticket = Ticket::factory()->create([
            'user_id' => $user->id,
            'title' => 'Test Ticket',
        ]);

        $response = $this->actingAs($user)->get("/tickets/{$ticket->id}");

        $response->assertStatus(200);
        $response->assertSee('Test Ticket');
    }

    public function test_user_cannot_view_other_users_ticket(): void
    {
        $user1 = User::factory()->create();
        $user2 = User::factory()->create();
        $ticket = Ticket::factory()->create(['user_id' => $user2->id]);

        $response = $this->actingAs($user1)->get("/tickets/{$ticket->id}");

        $response->assertStatus(403);
    }

    public function test_user_can_edit_own_ticket(): void
    {
        $user = User::factory()->create();
        $ticket = Ticket::factory()->create([
            'user_id' => $user->id,
            'title' => 'Original Title',
        ]);

        $response = $this->actingAs($user)->put("/tickets/{$ticket->id}", [
            'title' => 'Updated Title',
            'category' => 'Bug',
            'priority' => 'high',
            'description' => 'Updated description',
        ]);

        $response->assertRedirect('/dashboard');
        $this->assertDatabaseHas('tickets', [
            'id' => $ticket->id,
            'title' => 'Updated Title',
        ]);
    }

    public function test_user_can_delete_own_ticket(): void
    {
        $user = User::factory()->create();
        $ticket = Ticket::factory()->create(['user_id' => $user->id]);

        $response = $this->actingAs($user)->delete("/tickets/{$ticket->id}");

        $response->assertRedirect('/dashboard');
        $this->assertDatabaseMissing('tickets', ['id' => $ticket->id]);
    }

    public function test_guest_cannot_access_dashboard(): void
    {
        $response = $this->get('/dashboard');

        $response->assertRedirect('/login');
    }

    public function test_guest_cannot_create_ticket(): void
    {
        $response = $this->post('/tickets', [
            'title' => 'Test Ticket',
            'priority' => 'high',
            'description' => 'Test description',
        ]);

        $response->assertRedirect('/login');
    }
}
