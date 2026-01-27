<?php

namespace App\Http\Controllers;

use App\Enums\TicketStatus;
use App\Http\Requests\StoreTicketRequest;
use App\Models\Ticket;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class TicketController extends Controller
{
    public function index(): View
    {
        $tickets = auth()->user()
            ->tickets()
            ->with('assignee')
            ->latest()
            ->paginate(10);

        return view('dashboard', compact('tickets'));
    }

    public function store(StoreTicketRequest $request): RedirectResponse
    {
        auth()->user()->tickets()->create([
            ...$request->validated(),
            'status' => TicketStatus::NEW,
        ]);

        return redirect()
            ->route('dashboard')
            ->with('success', 'Ticket created successfully!');
    }

    public function show(Ticket $ticket): View
    {
        $this->authorize('view', $ticket);

        $ticket->load(['user', 'assignee']);

        return view('tickets.show', compact('ticket'));
    }

    public function edit(Ticket $ticket): View
    {
        $this->authorize('update', $ticket);

        return view('tickets.edit', compact('ticket'));
    }

    public function update(StoreTicketRequest $request, Ticket $ticket): RedirectResponse
    {
        $this->authorize('update', $ticket);

        $ticket->update($request->validated());

        return redirect()
            ->route('dashboard')
            ->with('success', 'Ticket updated successfully!');
    }

    public function destroy(Ticket $ticket): RedirectResponse
    {
        $this->authorize('delete', $ticket);

        $ticket->delete();

        return redirect()
            ->route('dashboard')
            ->with('success', 'Ticket deleted successfully!');
    }
}
