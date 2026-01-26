<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreTicketRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;

class RequestController extends Controller
{
    public function index()
    {
        return view('dashboard');
    }

    public function store(StoreTicketRequest $request): RedirectResponse
    {
        $user = Auth::user();
        if (! $user) {
            abort(403);
        }

        $user->tickets()->create([
            ...$request->validated(),
            'status' => 'new',
        ]);

        return redirect()
            ->route('dashboard')
            ->with('success', 'Request created successfully!');
    }
}
