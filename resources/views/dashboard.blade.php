<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            📚 My Reading Dashboard
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-4">
            <div class="bg-white dark:bg-gray-800 p-6 rounded shadow text-gray-900 dark:text-gray-100">
                <h3 class="text-lg font-bold mb-2">Welcome back!</h3>
                <p class="mb-4">You can manage your books or find new ones below.</p>
                <div class="flex gap-4">
                    <a href="{{ route('books.index') }}" class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">
                        📖 My Books
                    </a>
                    <a href="{{ route('books.search') }}" class="px-4 py-2 bg-green-600 text-white rounded hover:bg-green-700">
                        🔍 Search Books
                    </a>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
