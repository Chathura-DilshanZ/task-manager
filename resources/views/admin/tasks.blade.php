<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('All Assigned Tasks') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Success Message -->
            @if (session('success'))
                <div class="mb-4 p-4 bg-green-100 border border-green-400 text-green-700 rounded-lg shadow-sm"
                    id="successMessage">
                    <div class="flex items-center justify-between">
                        <span class="font-semibold">✓ {{ session('success') }}</span>
                        <button onclick="document.getElementById('successMessage').style.display='none'"
                            class="text-green-700 hover:text-green-900 font-bold">✕</button>
                    </div>
                </div>
            @endif

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Title
                                </th>
                                <th
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Description
                                </th>
                                <th
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Assigned To
                                </th>
                                <th
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Status
                                </th>
                                <th
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Note
                                </th>
                                <th
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Due Date
                                </th>
                                <th
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Created At
                                </th>
                                <th
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Actions
                                </th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @forelse($tasks as $task)
                                <tr>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                        {{ $task->title }}
                                    </td>
                                    <td class="px-6 py-4 text-sm text-gray-600 max-w-xs">
                                        <div class="truncate" title="{{ $task->description ?? 'No description' }}">
                                            {{ Str::limit($task->description ?? 'No description', 50) }}
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                        {{ $task->user->name ?? 'N/A' }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm">
                                        <span
                                            class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full
                                            @if ($task->status === 'completed') bg-green-100 text-green-800
                                            @else
                                                bg-yellow-100 text-yellow-800 @endif
                                        ">
                                            {{ ucfirst($task->status) }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                        {{ $task->status_note ?? '-' }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                        {{ $task->due_date ? $task->due_date->format('M d, Y') : 'No date' }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                        {{ $task->created_at->format('M d, Y') }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm space-x-6 flex">
                                        <a href="{{ route('admin.tasks.edit', $task->id) }}"
                                            class="inline-flex items-center px-3 py-1 border border-blue-300 rounded font-semibold text-xs text-blue-700 bg-blue-50 hover:bg-blue-100 transition duration-200">
                                            ✎ Edit
                                        </a>
                                        <button onclick="openDeleteModal({{ $task->id }}, '{{ $task->title }}')"
                                            class="inline-flex items-center px-3 py-1 border border-red-300 rounded font-semibold text-xs text-red-700 bg-red-50 hover:bg-red-100 transition duration-200">
                                            🗑 Delete
                                        </button>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="8"
                                        class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 text-center">
                                        No tasks assigned yet.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="mt-6">
                <a href="{{ route('admin.users') }}"
                    class="inline-flex items-center px-4 py-2 border border-gray-300 rounded-md font-semibold text-sm text-gray-700 bg-white hover:bg-gray-100 transition duration-200 shadow-sm">
                    ← Back to Users
                </a>
            </div>
        </div>
    </div>

    <!-- Delete Confirmation Modal -->
    <div id="deleteModal"
        class="hidden fixed inset-0 bg-black bg-opacity-40 flex items-center justify-center z-50 backdrop-blur-sm">
        <div class="bg-white rounded-lg shadow-2xl w-96 transform transition-all duration-300 ease-out scale-95 opacity-0 border-l-4 border-red-600"
            id="modalContent">
            <div class="bg-gradient-to-r from-red-50 to-red-100 px-6 py-4 border-b border-red-200">
                <h3 class="text-lg font-bold text-red-900">Delete Task</h3>
            </div>

            <div class="px-6 py-5">
                <div class="flex items-start gap-4 mb-4">
                    <div class="flex-shrink-0">
                        <div class="flex items-center justify-center h-12 w-12 rounded-full bg-red-100">
                            <svg class="h-6 w-6 text-red-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 8v4m0 4v.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </div>
                    </div>
                    <div class="flex-1">
                        <p class="text-sm text-gray-700">Are you sure you want to delete this task?</p>
                        <p class="text-sm font-semibold text-gray-900 mt-2"><span id="taskTitle"></span></p>

                    </div>
                </div>
            </div>

            <div class="bg-gray-50 px-6 py-4 flex gap-3 border-t border-gray-200 rounded-b-lg">
                <button onclick="closeDeleteModal()"
                    class="flex-1 px-4 py-2 bg-white text-gray-700 font-medium text-sm border border-gray-300 rounded-lg hover:bg-gray-50 transition duration-200">
                    Cancel
                </button>
                <form id="deleteForm" method="POST" style="flex: 1;">
                    @csrf
                    @method('DELETE')
                    <button type="submit"
                        class="w-full px-4 py-2 bg-red-600 text-white font-medium text-sm rounded-lg hover:bg-red-700 transition duration-200 flex items-center justify-center gap-2">
                        <svg class="h-4 w-4" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd"
                                d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z"
                                clip-rule="evenodd" />
                        </svg>
                        Delete
                    </button>
                </form>
            </div>
        </div>
    </div>

    <style>
        @keyframes slideIn {
            from {
                opacity: 0;
                transform: scale(0.95) translateY(-10px);
            }

            to {
                opacity: 1;
                transform: scale(1) translateY(0);
            }
        }

        #deleteModal.active #modalContent {
            animation: slideIn 0.3s ease-out;
            transform: scale(1);
            opacity: 1;
        }
    </style>

    <script>
        function openDeleteModal(taskId, taskTitle) {
            document.getElementById('taskTitle').textContent = taskTitle;
            document.getElementById('deleteForm').action = `/admin/tasks/${taskId}`;
            const modal = document.getElementById('deleteModal');
            modal.classList.remove('hidden');
            modal.classList.add('active');
            // Trigger reflow to enable animation
            modal.offsetHeight;
        }

        function closeDeleteModal() {
            const modal = document.getElementById('deleteModal');
            modal.classList.remove('active');
            setTimeout(() => {
                modal.classList.add('hidden');
            }, 300);
        }

        // Close modal when clicking outside
        document.getElementById('deleteModal').addEventListener('click', function(e) {
            if (e.target === this) {
                closeDeleteModal();
            }
        });

        // Close on Escape key
        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape' && !document.getElementById('deleteModal').classList.contains('hidden')) {
                closeDeleteModal();
            }
        });

        // Auto-hide success message after 5 seconds
        setTimeout(function() {
            const successMsg = document.getElementById('successMessage');
            if (successMsg) {
                successMsg.style.display = 'none';
            }
        }, 5000);
    </script>
</x-app-layout>
