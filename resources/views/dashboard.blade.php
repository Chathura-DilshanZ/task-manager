<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="mb-6">
                        {{ __("You're logged in!") }}
                    </div>
                    <a href="{{ route('tasks.index') }}" 
                       class="inline-block bg-gray-200 text-gray-900 px-6 py-3 rounded font-semibold border border-gray-900 hover:bg-gray-300 no-underline transition">
                        Go to Tasks
                    </a>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
