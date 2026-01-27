<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                Edit Ticket
            </h2>
            <a href="{{ route('tickets.show', $ticket) }}" class="text-sm text-blue-600 hover:text-blue-800 dark:text-blue-400">
                &larr; Back to Ticket
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">

                    @if($errors->any())
                        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
                            <ul class="list-disc list-inside">
                                @foreach($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form method="POST" action="{{ route('tickets.update', $ticket) }}" class="space-y-6">
                        @csrf
                        @method('PUT')

                        <div>
                            <label for="title" class="block text-sm font-medium text-gray-700 dark:text-gray-200">
                                Title <span class="text-red-500">*</span>
                            </label>
                            <input
                                type="text"
                                name="title"
                                id="title"
                                value="{{ old('title', $ticket->title) }}"
                                class="mt-1 block w-full rounded-md border-gray-300 dark:border-gray-600 dark:bg-gray-700 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm"
                                required
                            >
                        </div>

                        <div>
                            <label for="category" class="block text-sm font-medium text-gray-700 dark:text-gray-200">
                                Category
                            </label>
                            <input
                                type="text"
                                name="category"
                                id="category"
                                value="{{ old('category', $ticket->category) }}"
                                class="mt-1 block w-full rounded-md border-gray-300 dark:border-gray-600 dark:bg-gray-700 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm"
                                placeholder="e.g., Bug, Feature Request, Support"
                            >
                        </div>

                        <div>
                            <label for="priority" class="block text-sm font-medium text-gray-700 dark:text-gray-200">
                                Priority <span class="text-red-500">*</span>
                            </label>
                            <select
                                name="priority"
                                id="priority"
                                class="mt-1 block w-full rounded-md border-gray-300 dark:border-gray-600 dark:bg-gray-700 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm"
                                required
                            >
                                <option value="low" {{ old('priority', $ticket->priority->value) === 'low' ? 'selected' : '' }}>Low</option>
                                <option value="medium" {{ old('priority', $ticket->priority->value) === 'medium' ? 'selected' : '' }}>Medium</option>
                                <option value="high" {{ old('priority', $ticket->priority->value) === 'high' ? 'selected' : '' }}>High</option>
                            </select>
                        </div>

                        <div>
                            <label for="description" class="block text-sm font-medium text-gray-700 dark:text-gray-200">
                                Description <span class="text-red-500">*</span>
                            </label>
                            <textarea
                                name="description"
                                id="description"
                                rows="6"
                                class="mt-1 block w-full rounded-md border-gray-300 dark:border-gray-600 dark:bg-gray-700 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm"
                                required
                            >{{ old('description', $ticket->description) }}</textarea>
                        </div>

                        <div>
                            <label for="due_date" class="block text-sm font-medium text-gray-700 dark:text-gray-200">
                                Due Date
                            </label>
                            <input
                                type="date"
                                name="due_date"
                                id="due_date"
                                value="{{ old('due_date', $ticket->due_date?->format('Y-m-d')) }}"
                                class="mt-1 block w-full rounded-md border-gray-300 dark:border-gray-600 dark:bg-gray-700 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm"
                            >
                        </div>

                        <div class="flex gap-3">
                            <button type="submit" class="inline-flex items-center px-6 py-2 bg-blue-600 text-white font-semibold rounded-md shadow-md hover:bg-blue-700">
                                Update Ticket
                            </button>
                            <a href="{{ route('tickets.show', $ticket) }}" class="inline-flex items-center px-6 py-2 bg-gray-300 text-gray-700 font-semibold rounded-md shadow-md hover:bg-gray-400">
                                Cancel
                            </a>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
