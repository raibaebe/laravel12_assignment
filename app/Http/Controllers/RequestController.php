<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

// Make sure to import the correct model for requests

class RequestController extends Controller
{
    // Show the user dashboard (where the form will be)
    public function index()
    {
        // Return the dashboard view
        return view('dashboard');
    }

    // Store the new request in the database
    public function store(Request $request)
    {
        // Validate the incoming request data
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
        ]);

        // Store the request in the database and associate it with the logged-in user
        auth()->user()->requests()->create([
            'title' => $request->title,
            'description' => $request->description,
        ]);

        // Redirect back to the dashboard with a success message
        return redirect()->route('dashboard')->with('success', 'Request created successfully!');
    }
}
