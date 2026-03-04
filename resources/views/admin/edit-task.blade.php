<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit Task') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <form method="POST" action="{{ route('admin.tasks.update', $task->id) }}">
                        @csrf
                        @method('PATCH')

                        <div class="mb-6">
                            <label for="title" class="block text-sm font-medium text-gray-700 mb-2">
                                Task Title
                            </label>
                            <input type="text" id="title" name="title" value="{{ old('title', $task->title) }}"
                                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500"
                                required>
                            @error('title')
                                <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="mb-6">
                            <label for="description" class="block text-sm font-medium text-gray-700 mb-2">
                                Description
                            </label>
                            <textarea id="description" name="description" rows="4"
                                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500">{{ old('description', $task->description) }}</textarea>
                            @error('description')
                                <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="mb-6">
                            <label for="user_id" class="block text-sm font-medium text-gray-700 mb-2">
                                Assign To
                            </label>
                            <select id="user_id" name="user_id"
                                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500"
                                required>
                                <option value="">-- Select User --</option>
                                @foreach ($users as $user)
                                    <option value="{{ $user->id }}"
                                        {{ old('user_id', $task->user_id) == $user->id ? 'selected' : '' }}>
                                        {{ $user->name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('user_id')
                                <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="mb-6">
                            <label for="due_date" class="block text-sm font-medium text-gray-700 mb-2">
                                Due Date
                            </label>
                            <input type="date" id="due_date" name="due_date"
                                value="{{ old('due_date', $task->due_date ? $task->due_date->format('Y-m-d') : '') }}"
                                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500">
                            @error('due_date')
                                <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="flex gap-4 mt-8 pt-6 border-t border-gray-200">


                            <button type="submit"
                                class="flex items-center gap-2 px-6 py-3 bg-indigo-600 text-black border border-indigo-600 font-semibold text-sm rounded-lg hover:bg-gray-100 transition duration-200 shadow-sm">
                                Save Changes
                            </button>

                            <a href="{{ route('admin.tasks') }}"
                                class="flex items-center gap-2 px-6 py-3 border border-gray-300 rounded-lg font-semibold text-sm text-gray-700 bg-white hover:bg-gray-100 transition duration-200">
                                Cancel
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
