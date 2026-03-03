<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            @if(auth()->user()->isAdmin())
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                    <!-- Admin Panel Card -->
                    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                        <div class="p-6 text-gray-900">
                            <h3 class="text-lg font-semibold mb-4">{{ __('Admin Panel') }}</h3>
                            <div class="space-y-3">
                                <a href="{{ route('admin.users') }}" 
                                   class="block w-full text-center bg-green-700 text-black px-6 py-4 rounded-lg font-extrabold text-lg hover:bg-green-800 transition shadow-lg">
                                    {{ __('Manage Users & Assign Tasks') }}
                                </a>
                                <a href="{{ route('admin.tasks') }}" 
                                   class="block w-full text-center bg-blue-700 text-black px-6 py-4 rounded-lg font-extrabold text-lg hover:bg-blue-800 transition shadow-lg">
                                    {{ __('View All Assigned Tasks') }}
                                </a>
                            </div>
                        </div>
                    </div>

                    <!-- User Tasks Card -->
                    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                        <div class="p-6 text-gray-900">
                            <h3 class="text-lg font-semibold mb-4">{{ __('My Tasks') }}</h3>
                            <a href="{{ route('tasks.index') }}" 
                               class="block w-full text-center bg-gray-200 text-gray-900 px-4 py-2 rounded font-semibold border border-gray-900 hover:bg-gray-300 transition">
                                {{ __('Go to Tasks') }}
                            </a>
                        </div>
                    </div>
                </div>
            @else
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
            @endif
        </div>
    </div>
</x-app-layout>
