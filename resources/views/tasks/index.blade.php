<x-app-layout>
    <div class="max-w-5xl mx-auto py-6">

        <div class="flex justify-between mb-4">
            <h2 class="text-2xl font-bold">My Tasks</h2>
            <a href="{{ route('tasks.create') }}" 
               class="bg-gray-200 text-gray-900 px-4 py-2 rounded border border-gray-900 hover:bg-gray-300 no-underline inline-block font-semibold">
                + New Task
            </a>
        </div>

        <!-- Filter -->
        <form method="GET" class="mb-4 flex gap-2">
            <input type="text" name="search" placeholder="Search..."
                   class="border p-2 rounded">

            <select name="status" class="border p-2 rounded">
                <option value="">All</option>
                <option value="pending">Pending</option>
                <option value="completed">Completed</option>
            </select>

            <button class="bg-gray-200 text-gray-900 px-4 py-2 rounded border border-gray-900 hover:bg-gray-300 font-semibold">
                Filter
            </button>
        </form>

        <!-- Success Message -->
        @if(session('success'))
            <div class="bg-green-200 p-3 mb-4 rounded">
                {{ session('success') }}
            </div>
        @endif

        <!-- Task Table -->
        <table class="w-full border">
            <thead class="bg-gray-200">
                <tr>
                    <th class="p-2 border">Title</th>
                    <th class="p-2 border">Status</th>
                    <th class="p-2 border">Due Date</th>
                    <th class="p-2 border">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($tasks as $task)
                    <tr>
                        <td class="p-2 border">{{ $task->title }}</td>
                        <td class="p-2 border">{{ $task->status }}</td>
                        <td class="p-2 border">{{ $task->due_date ? $task->due_date->format('M d, Y') : 'No date' }}</td>
                        <td class="p-2 border flex gap-2">

                            <a href="{{ route('tasks.edit', $task) }}"
                               class="bg-gray-200 text-gray-900 px-3 py-1 rounded border border-gray-900 hover:bg-gray-300 no-underline font-semibold">
                                Edit
                            </a>

                            <button onclick="openDeleteModal({{ $task->id }}, '{{ route('tasks.destroy', $task) }}')"
                                    class="bg-gray-200 text-gray-900 px-3 py-1 rounded border border-gray-900 hover:bg-gray-300 font-semibold">
                                Delete
                            </button>

                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4" class="text-center p-4">
                            No tasks found.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>

        <div class="mt-4">
            {{ $tasks->links() }}
        </div>

    </div>

    <!-- Delete Modal -->
    <div id="deleteModal" class="hidden fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50">
        <div class="bg-white rounded-lg shadow-lg p-6 max-w-sm">
            <h3 class="text-lg font-bold mb-4">Confirm Delete</h3>
            <p class="text-gray-700 mb-6">Are you sure you want to delete this task?</p>
            <div class="flex gap-3 justify-end">
                <button onclick="closeDeleteModal()" class="bg-gray-200 text-gray-900 px-4 py-2 rounded border border-gray-900 hover:bg-gray-300 font-semibold">
                    Cancel
                </button>
                <button onclick="confirmDelete()" class="bg-gray-200 text-gray-900 px-4 py-2 rounded border border-gray-900 hover:bg-gray-300 font-semibold">
                    Delete
                </button>
            </div>
        </div>
    </div>

    <script>
        let deleteUrl = '';
        
        function openDeleteModal(taskId, url) {
            deleteUrl = url;
            document.getElementById('deleteModal').classList.remove('hidden');
        }
        
        function closeDeleteModal() {
            document.getElementById('deleteModal').classList.add('hidden');
            deleteUrl = '';
        }
        
        function confirmDelete() {
            if (deleteUrl) {
                const form = document.createElement('form');
                form.method = 'POST';
                form.action = deleteUrl;
                form.innerHTML = `
                    {{ csrf_field() }}
                    <input type="hidden" name="_method" value="DELETE">
                `;
                document.body.appendChild(form);
                form.submit();
            }
        }
        
        // Close modal when clicking outside
        document.getElementById('deleteModal')?.addEventListener('click', function(e) {
            if (e.target === this) {
                closeDeleteModal();
            }
        });
    </script>
</x-app-layout>