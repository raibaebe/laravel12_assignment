<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    {{ __("You're logged in!") }}

                    <!-- Display success message if ticket was created successfully -->
                    @if(session('success'))
                        <div class="alert alert-success bg-green-500 text-white p-2 rounded mb-4">
                            {{ session('success') }}
                        </div>
                    @endif

                    <!-- Ticket creation form -->
                    <form method="POST" action="{{ route('tickets.store') }}" class="space-y-4">
                        @csrf

                        <div>
                            <label for="title" class="block text-sm font-medium text-gray-700 dark:text-gray-200">Title</label>
                            <input type="text" name="title" id="title" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm sm:text-sm" placeholder="Enter ticket title" required>
                        </div>

                        <div>
                            <label for="category" class="block text-sm font-medium text-gray-700 dark:text-gray-200">Category</label>
                            <input type="text" name="category" id="category" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm sm:text-sm" placeholder="Enter category (e.g. Issue, Request)" required>
                        </div>

                        <div>
                            <label for="priority" class="block text-sm font-medium text-gray-700 dark:text-gray-200">Priority</label>
                            <select name="priority" id="priority" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm sm:text-sm" required>
                                <option value="low">Low</option>
                                <option value="medium">Medium</option>
                                <option value="high">High</option>
                            </select>
                        </div>

                        <div>
                            <label for="description" class="block text-sm font-medium text-gray-700 dark:text-gray-200">Description</label>
                            <textarea name="description" id="description" rows="4" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm sm:text-sm" placeholder="Enter ticket description" required></textarea>
                        </div>

                        <div>
                            <label for="due_date" class="block text-sm font-medium text-gray-700 dark:text-gray-200">Due Date</label>
                            <input type="date" name="due_date" id="due_date" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm sm:text-sm" required>
                        </div>

                        <button type="submit" class="inline-flex items-center px-4 py-2 bg-blue-600 text-white font-semibold rounded-md shadow-md hover:bg-blue-500">
                            Create Ticket
                        </button>
                    </form>

                    <!-- List of user tickets -->
                    <h2 class="text-xl font-semibold mt-8">Your Tickets</h2>
                    <ul class="space-y-4">
                        @foreach(auth()->user()->tickets as $ticket)
                            <li class="bg-gray-100 p-4 rounded-md shadow-sm">
                                <h3 class="font-semibold text-lg">{{ $ticket->title }}</h3>
                                <p class="text-sm text-gray-600">{{ $ticket->description }}</p>
                                <span class="text-xs text-gray-500">Status: {{ $ticket->status }}</span>
                            </li>
                        @endforeach
                    </ul>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
