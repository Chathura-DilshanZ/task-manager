<x-app-layout>
    <div class="max-w-3xl mx-auto py-6">

        <h2 class="text-2xl font-bold mb-4">Create Task</h2>

        <form action="{{ route('tasks.store') }}" method="POST">
            @csrf

            <div class="mb-3">
                <label>Title</label>
                <input type="text" name="title"
                       class="w-full border p-2 rounded">
            </div>

            <div class="mb-3">
                <label>Description</label>
                <textarea name="description"
                          class="w-full border p-2 rounded"></textarea>
            </div>

            <div class="mb-3">
                <label>Due Date</label>
                <input type="date" name="due_date"
                       class="w-full border p-2 rounded">
            </div>

            <button class="bg-gray-200 text-gray-900 px-4 py-2 rounded border border-gray-900 hover:bg-gray-300 font-semibold">
                Save
            </button>

            <a href="{{ route('tasks.index') }}" 
               class="ml-3 px-4 py-2 rounded bg-gray-200 text-gray-900 border border-gray-900 hover:bg-gray-300 no-underline inline-block font-semibold">
                Cancel
            </a>

        </form>

    </div>
</x-app-layout>