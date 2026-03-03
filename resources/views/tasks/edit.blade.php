<x-app-layout>
    <div class="max-w-3xl mx-auto py-6">

        <h2 class="text-2xl font-bold mb-4">Edit Task</h2>

        <form action="{{ route('tasks.update', $task) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label>Title</label>
                <input type="text" name="title"
                       value="{{ $task->title }}"
                       class="w-full border p-2 rounded">
            </div>

            <div class="mb-3">
                <label>Description</label>
                <textarea name="description"
                          class="w-full border p-2 rounded">{{ $task->description }}</textarea>
            </div>

            <div class="mb-3">
                <label>Status</label>
                <select name="status"
                        class="w-full border p-2 rounded">
                    <option value="pending" 
                        {{ $task->status == 'pending' ? 'selected' : '' }}>
                        Pending
                    </option>
                    <option value="completed"
                        {{ $task->status == 'completed' ? 'selected' : '' }}>
                        Completed
                    </option>
                </select>
            </div>

            <div class="mb-3">
                <label>Due Date</label>
                <input type="date" name="due_date"
                       value="{{ $task->due_date ? $task->due_date->format('Y-m-d') : '' }}"
                       class="w-full border p-2 rounded">
            </div>

            <button class="bg-gray-200 text-gray-900 px-4 py-2 rounded border border-gray-900 hover:bg-gray-300 font-semibold">
                Update
            </button>

            <a href="{{ route('tasks.index') }}" 
               class="ml-3 px-4 py-2 rounded bg-gray-200 text-gray-900 border border-gray-900 hover:bg-gray-300 no-underline inline-block font-semibold">
                Cancel
            </a>

            <button type="button" 
                    onclick="openDeleteModal('{{ route('tasks.destroy', $task) }}')"
                    class="ml-2 bg-gray-200 text-gray-900 px-4 py-2 rounded border border-gray-900 hover:bg-gray-300 font-semibold">
                Delete
            </button>

        </form>

    </div>

    <!-- Delete Modal -->
    <div id="deleteModal" class="hidden fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50">
        <div class="bg-white rounded-lg shadow-lg p-6 max-w-sm">
            <h3 class="text-lg font-bold mb-4">Confirm Delete</h3>
            <p class="text-gray-700 mb-6">Are you sure you want to delete this task? </p>
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
        
        function openDeleteModal(url) {
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