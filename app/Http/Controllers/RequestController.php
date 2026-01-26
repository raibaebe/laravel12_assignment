<?php

namespace App\Http\Controllers;

use App\Models\Ticket;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RequestController extends Controller
{
    public function index()
    {
        return view('dashboard');
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'description' => ['required', 'string'],
        ]);

        $user = Auth::user();
        if (! $user) {
            abort(403);
        }

        $user->tickets()->create([
            'title' => $validated['title'],
            'description' => $validated['description'],
             'category' => $request->input('category'),
             'priority' => $request->input('priority'),
            'due_date' => $request->input('due_date'),
            'status' => 'new',
        ]);

        return redirect()
            ->route('dashboard')
            ->with('success', 'Request created successfully!');
    }
}
