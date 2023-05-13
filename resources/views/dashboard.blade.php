<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            @if (Route::is('dashboard.admin.create'))
                {{ __('Create Image') }}
            @endif
            @if(Route::is('dashboard'))
                {{ __('Dashboard') }}
            @endif
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-xl sm:rounded-lg">
                <livewire:image />
            </div>
        </div>
    </div>
</x-app-layout>
