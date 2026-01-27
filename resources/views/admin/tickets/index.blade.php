<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            Admin Panel - All Tickets
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">

            @if(session('success'))
                <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 rounded shadow-sm">
                    <p class="font-medium">{{ session('success') }}</p>
                </div>
            @endif

            <!-- Filters -->
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <h3 class="text-lg font-semibold text-gray-900 dark:text-gray-100 mb-4">
                        Filters
                    </h3>

                    <form method="GET" action="{{ route('admin.tickets.index') }}" class="space-y-4">
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                            <div>
                                <label for="status" class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                                    Status
                                </label>
                                <select
                                    name="status"
                                    id="status"
                                    class="mt-1 block w-full rounded-md border-gray-300 dark:border-gray-600 dark:bg-gray-700 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm"
                                >
                                    <option value="">All Statuses</option>
                                    <option value="new" {{ request('status') === 'new' ? 'selected' : '' }}>New</option>
                                    <option value="in_progress" {{ request('status') === 'in_progress' ? 'selected' : '' }}>In Progress</option>
                                    <option value="done" {{ request('status') === 'done' ? 'selected' : '' }}>Done</option>
                                    <option value="rejected" {{ request('status') === 'rejected' ? 'selected' : '' }}>Rejected</option>
                                </select>
                            </div>

                            <div>
                                <label for="priority" class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                                    Priority
                                </label>
                                <select
                                    name="priority"
                                    id="priority"
                                    class="mt-1 block w-full rounded-md border-gray-300 dark:border-gray-600 dark:bg-gray-700 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm"
                                >
                                    <option value="">All Priorities</option>
                                    <option value="low" {{ request('priority') === 'low' ? 'selected' : '' }}>Low</option>
                                    <option value="medium" {{ request('priority') === 'medium' ? 'selected' : '' }}>Medium</option>
                                    <option value="high" {{ request('priority') === 'high' ? 'selected' : '' }}>High</option>
                                </select>
                            </div>

                            <div>
                                <label for="search" class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                                    Search
                                </label>
                                <input
                                    type="text"
                                    name="search"
                                    id="search"
                                    value="{{ request('search') }}"
                                    placeholder="Search by title or description..."
                                    class="mt-1 block w-full rounded-md border-gray-300 dark:border-gray-600 dark:bg-gray-700 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm"
                                >
                            </div>
                        </div>

                        <div class="flex gap-3">
                            <button type="submit" class="inline-flex items-center px-4 py-2 bg-blue-600 text-white font-semibold rounded-md shadow-md hover:bg-blue-700 transition">
                                Apply Filters
                            </button>
                            <a href="{{ route('admin.tickets.index') }}" class="inline-flex items-center px-4 py-2 bg-gray-300 dark:bg-gray-600 text-gray-700 dark:text-gray-200 font-semibold rounded-md shadow-md hover:bg-gray-400 dark:hover:bg-gray-500 transition">
                                Clear
                            </a>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Tickets Table -->
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <div class="flex justify-between items-center mb-4">
                        <h3 class="text-lg font-semibold text-gray-900 dark:text-gray-100">
                            All Tickets ({{ $tickets->total() }})
                        </h3>
                    </div>

                    @if($tickets->isEmpty())
                        <div class="text-center py-12">
                            <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                            </svg>
                            <h3 class="mt-2 text-sm font-medium text-gray-900 dark:text-gray-100">No tickets found</h3>
                            <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">Try adjusting your filters.</p>
                        </div>
                    @else
                        <div class="overflow-x-auto">
                            <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                                <thead class="bg-gray-50 dark:bg-gray-700">
                                    <tr>
                                        <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                                            Ticket
                                        </th>
                                        <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                                            User
                                        </th>
                                        <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                                            Priority
                                        </th>
                                        <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                                            Due Date
                                        </th>
                                        <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                                            Assignee
                                        </th>
                                        <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                                            Status
                                        </th>
                                        <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                                            Actions
                                        </th>
                                    </tr>
                                </thead>
                                <tbody class="bg-white dark:bg-gray-800 divide-y divide-gray-200 dark:divide-gray-700">
                                    @foreach($tickets as $ticket)
                                        <tr class="hover:bg-gray-50 dark:hover:bg-gray-700 transition">
                                            <td class="px-4 py-4">
                                                <div class="text-sm font-medium text-gray-900 dark:text-gray-100">
                                                    {{ Str::limit($ticket->title, 50) }}
                                                </div>
                                                @if($ticket->category)
                                                    <div class="text-xs text-gray-500 dark:text-gray-400">
                                                        {{ $ticket->category }}
                                                    </div>
                                                @endif
                                            </td>
                                            <td class="px-4 py-4 whitespace-nowrap">
                                                <div class="text-sm text-gray-900 dark:text-gray-100">
                                                    {{ $ticket->user->name }}
                                                </div>
                                                <div class="text-xs text-gray-500 dark:text-gray-400">
                                                    {{ $ticket->user->email }}
                                                </div>
                                            </td>
                                            <td class="px-4 py-4 whitespace-nowrap">
                                                <span class="px-2 py-1 text-xs font-semibold rounded-full bg-{{ $ticket->priority->color() }}-100 text-{{ $ticket->priority->color() }}-800">
                                                    {{ $ticket->priority->label() }}
                                                </span>
                                            </td>
                                            <td class="px-4 py-4 whitespace-nowrap text-sm text-gray-500 dark:text-gray-400">
                                                {{ $ticket->due_date?->format('M d, Y') ?? 'N/A' }}
                                            </td>
                                            <td class="px-4 py-4 whitespace-nowrap">
                                                <form method="POST" action="{{ route('admin.tickets.assign', $ticket) }}" class="flex items-center gap-2">
                                                    @csrf
                                                    @method('PATCH')
                                                    <select
                                                        name="assignee_id"
                                                        class="text-xs border-gray-300 dark:border-gray-600 dark:bg-gray-700 rounded shadow-sm"
                                                        onchange="this.form.submit()"
                                                    >
                                                        <option value="">Unassigned</option>
                                                        @foreach($users as $user)
                                                            <option value="{{ $user->id }}" {{ $ticket->assignee_id === $user->id ? 'selected' : '' }}>
                                                                {{ $user->name }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </form>
                                            </td>
                                            <td class="px-4 py-4 whitespace-nowrap">
                                                <form method="POST" action="{{ route('admin.tickets.update-status', $ticket) }}" class="flex items-center gap-2">
                                                    @csrf
                                                    @method('PATCH')
                                                    <select
                                                        name="status"
                                                        class="text-xs border-gray-300 dark:border-gray-600 dark:bg-gray-700 rounded shadow-sm"
                                                        onchange="this.form.submit()"
                                                    >
                                                        <option value="new" {{ $ticket->status->value === 'new' ? 'selected' : '' }}>New</option>
                                                        <option value="in_progress" {{ $ticket->status->value === 'in_progress' ? 'selected' : '' }}>In Progress</option>
                                                        <option value="done" {{ $ticket->status->value === 'done' ? 'selected' : '' }}>Done</option>
                                                        <option value="rejected" {{ $ticket->status->value === 'rejected' ? 'selected' : '' }}>Rejected</option>
                                                    </select>
                                                </form>
                                            </td>
                                            <td class="px-4 py-4 whitespace-nowrap text-sm font-medium">
                                                <a href="{{ route('tickets.show', $ticket) }}" class="text-blue-600 hover:text-blue-900 dark:text-blue-400 dark:hover:text-blue-300">
                                                    View
                                                </a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>

                        <!-- Pagination -->
                        <div class="mt-4">
                            {{ $tickets->links() }}
                        </div>
                    @endif
                </div>
            </div>

        </div>
    </div>
</x-app-layout>
