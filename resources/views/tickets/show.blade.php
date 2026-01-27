<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                Ticket Details
            </h2>
            <a href="{{ route('dashboard') }}" class="text-sm text-blue-600 hover:text-blue-800 dark:text-blue-400">
                &larr; Back to Dashboard
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">

                    <!-- Ticket Header -->
                    <div class="mb-6">
                        <div class="flex justify-between items-start mb-4">
                            <h1 class="text-3xl font-bold">{{ $ticket->title }}</h1>
                            <span class="px-3 py-1 text-sm font-semibold rounded-full bg-{{ $ticket->status->color() }}-100 text-{{ $ticket->status->color() }}-800">
                                {{ $ticket->status->label() }}
                            </span>
                        </div>

                        <div class="flex gap-4 text-sm text-gray-600 dark:text-gray-400">
                            <span class="flex items-center gap-1">
                                <strong>Priority:</strong>
                                <span class="px-2 py-0.5 rounded bg-{{ $ticket->priority->color() }}-100 text-{{ $ticket->priority->color() }}-800 font-medium">
                                    {{ $ticket->priority->label() }}
                                </span>
                            </span>
                            @if($ticket->category)
                            <span><strong>Category:</strong> {{ $ticket->category }}</span>
                            @endif
                            @if($ticket->due_date)
                            <span><strong>Due:</strong> {{ $ticket->due_date->format('M d, Y') }}</span>
                            @endif
                        </div>
                    </div>

                    <!-- Description -->
                    <div class="mb-6">
                        <h3 class="text-lg font-semibold mb-2">Description</h3>
                        <p class="text-gray-700 dark:text-gray-300 whitespace-pre-line">{{ $ticket->description }}</p>
                    </div>

                    <!-- Metadata -->
                    <div class="border-t pt-4 space-y-2 text-sm">
                        <p><strong>Created by:</strong> {{ $ticket->user->name }} ({{ $ticket->user->email }})</p>
                        @if($ticket->assignee)
                        <p><strong>Assigned to:</strong> {{ $ticket->assignee->name }} ({{ $ticket->assignee->email }})</p>
                        @endif
                        <p><strong>Created at:</strong> {{ $ticket->created_at->format('M d, Y H:i') }}</p>
                        <p><strong>Last updated:</strong> {{ $ticket->updated_at->format('M d, Y H:i') }}</p>
                    </div>

                    <!-- Actions -->
                    @can('update', $ticket)
                    <div class="mt-6 flex gap-3">
                        <a href="{{ route('tickets.edit', $ticket) }}" class="inline-flex items-center px-4 py-2 bg-blue-600 text-white font-semibold rounded-md shadow-md hover:bg-blue-700">
                            Edit Ticket
                        </a>

                        @can('delete', $ticket)
                        <form method="POST" action="{{ route('tickets.destroy', $ticket) }}" onsubmit="return confirm('Are you sure you want to delete this ticket?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="inline-flex items-center px-4 py-2 bg-red-600 text-white font-semibold rounded-md shadow-md hover:bg-red-700">
                                Delete Ticket
                            </button>
                        </form>
                        @endcan
                    </div>
                    @endcan

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
