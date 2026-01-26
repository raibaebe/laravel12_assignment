<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdateTicketStatusRequest;
use App\Models\Ticket;
use Illuminate\Http\RedirectResponse;

class AdminController extends Controller
{
    public function index()
    {
        $tickets = Ticket::with('user')->latest()->get();

        return view('admin.requests.index', compact('tickets'));
    }

    public function updateStatus(UpdateTicketStatusRequest $request, Ticket $ticket): RedirectResponse
    {
        $ticket->update($request->validated());

        return redirect()
            ->route('admin.requests.index')
            ->with('success', 'Status updated!');
    }
}
