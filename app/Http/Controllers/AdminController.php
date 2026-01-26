<?php

namespace App\Http\Controllers;

use App\Models\Ticket;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index()
    {
        $tickets = Ticket::with('user')->latest()->get();

        return view('admin.requests.index', compact('tickets'));
    }

    public function updateStatus(Request $request, Ticket $ticket): RedirectResponse
    {
        $data = $request->validate([
            'status' => ['required', 'in:new,in_progress,done,rejected'],
        ]);

        $ticket->update($data);

        return redirect()
            ->route('admin.requests.index')
            ->with('success', 'Status updated!');
    }
}
