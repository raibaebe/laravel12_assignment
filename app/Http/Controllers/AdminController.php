<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdateTicketStatusRequest;
use App\Models\Ticket;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class AdminController extends Controller
{
    public function index(Request $request): View
    {
        $query = Ticket::with(['user', 'assignee']);

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        if ($request->filled('priority')) {
            $query->where('priority', $request->priority);
        }

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('title', 'like', "%{$search}%")
                    ->orWhere('description', 'like', "%{$search}%");
            });
        }

        $tickets = $query->latest()->paginate(15)->withQueryString();
        $users = User::where('is_admin', true)->get();

        return view('admin.tickets.index', compact('tickets', 'users'));
    }

    public function updateStatus(UpdateTicketStatusRequest $request, Ticket $ticket): RedirectResponse
    {
        $this->authorize('updateStatus', $ticket);

        $ticket->update($request->validated());

        return redirect()
            ->route('admin.tickets.index')
            ->with('success', 'Status updated successfully!');
    }

    public function assignTicket(Request $request, Ticket $ticket): RedirectResponse
    {
        $this->authorize('updateStatus', $ticket);

        $request->validate([
            'assignee_id' => ['required', 'exists:users,id'],
        ]);

        $ticket->update([
            'assignee_id' => $request->assignee_id,
        ]);

        return redirect()
            ->route('admin.tickets.index')
            ->with('success', 'Ticket assigned successfully!');
    }
}
