<?php

namespace App\Http\Controllers;

use App\Models\Ticket;
use Illuminate\Http\Request;

class TicketController extends Controller
{
    public function index()
    {
        $tickets = auth()->user()->tickets()->latest()->get();
        return view('dashboard', compact('tickets'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'title' => 'required|string|max:255',
            'category' => 'nullable|string|max:255',
            'priority' => 'required|string|in:low,medium,high',
            'description' => 'required|string',
            'due_date' => 'nullable|date',
        ]);

        auth()->user()->tickets()->create($data);

        return redirect()->route('dashboard')->with('success', 'Ticket created successfully!');
    }
}
