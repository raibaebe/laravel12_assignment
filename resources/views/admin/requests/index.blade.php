<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            Admin – All Requests
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            @if(session('success'))
                <div class="bg-green-500 text-white p-3 rounded mb-4">
                    {{ session('success') }}
                </div>
            @endif

            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">

                    <table class="min-w-full table-auto border">
                        <thead class="bg-gray-100 dark:bg-gray-700">
                            <tr>
                                <th class="px-4 py-2 border">Title</th>
                                <th class="px-4 py-2 border">Description</th>
                                <th class="px-4 py-2 border">User</th>
                                <th class="px-4 py-2 border">Status</th>
                                <th class="px-4 py-2 border">Action</th>
                            </tr>
                        </thead>

                        <tbody>
                            @foreach($tickets as $ticket)
                                <tr class="border-b">
                                    <td class="px-4 py-2 border">{{ $ticket->title }}</td>
                                    <td class="px-4 py-2 border">{{ $ticket->description }}</td>
                                    <td class="px-4 py-2 border">{{ $ticket->user->email ?? '—' }}</td>
                                    <td class="px-4 py-2 border">{{ $ticket->status }}</td>
                                    <td class="px-4 py-2 border">
                                        <form method="POST" action="{{ route('admin.requests.update', $ticket) }}">
                                            @csrf
                                            @method('PATCH')

                                            <select name="status" class="border rounded px-2 py-1 text-black">
                                                <option value="new" {{ $ticket->status === 'new' ? 'selected' : '' }}>New</option>
                                                <option value="in_progress" {{ $ticket->status === 'in_progress' ? 'selected' : '' }}>In Progress</option>
                                                <option value="done" {{ $ticket->status === 'done' ? 'selected' : '' }}>Done</option>
                                                <option value="rejected" {{ $ticket->status === 'rejected' ? 'selected' : '' }}>Rejected</option>
                                            </select>

                                            <button type="submit" class="ml-2 bg-blue-600 text-white px-3 py-1 rounded">
                                                Update
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>

                </div>
            </div>

        </div>
    </div>
</x-app-layout>
