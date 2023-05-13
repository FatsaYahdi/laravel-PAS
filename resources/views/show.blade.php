<x-app-layout>
    <x-slot name="header">
        <span class="dark:text-white font-bold">Showing Image</span>
    </x-slot>
    <div class="flex justify-center items-center min-h-screen">
        <div class="w-full lg:max-w-5xl">
            <div class="sm:px-6 lg:px-8 dark:text-white text-center">
                <p class="text-2xl font-bold my-4">{{ $image->title }}</p>
                <img class="mx-auto h-auto max-w-full rounded-lg" src="{{ asset('storage/images/'. $image->image_name) }}" alt="image description">
                <p class="text-md py-6">{{ $image->description }}</p>
            </div>
        </div>
    </div>
</x-app-layout>
