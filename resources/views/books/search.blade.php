@extends('layouts.app')

@section('content')
<div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    <h1 class="text-3xl font-bold text-gray-800 dark:text-white mb-6">🔍 Search for Books</h1>

    <form method="GET" action="{{ route('books.search') }}" class="flex flex-col sm:flex-row gap-4 mb-8">
        <input 
            type="text" 
            name="q" 
            value="{{ $query ?? '' }}" 
            placeholder="Search for books..." 
            class="flex-1 border-gray-300 dark:border-gray-700 dark:bg-gray-800 dark:text-white rounded px-4 py-2 shadow-sm focus:ring-indigo-500 focus:border-indigo-500"
        >
        <button 
            type="submit" 
            class="bg-indigo-600 hover:bg-indigo-700 text-white font-semibold px-6 py-2 rounded shadow transition"
        >
            Search
        </button>
    </form>

    @if(isset($results))
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            @forelse($results as $book)
                <div class="bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 p-5 rounded-xl shadow-sm hover:shadow-md transition">
                    <h2 class="text-xl font-semibold text-gray-800 dark:text-white">{{ $book['title'] ?? 'No Title' }}</h2>
                    <p class="text-sm text-gray-600 dark:text-gray-300 mb-2">Author: {{ $book['author_name'][0] ?? 'Unknown' }}</p>

                    @if(isset($book['cover_i']))
                        <img src="https://covers.openlibrary.org/b/id/{{ $book['cover_i'] }}-M.jpg" alt="Cover" class="rounded mt-2 mb-4 w-full max-w-[150px]">
                    @endif

                    <form method="GET" action="{{ route('books.create') }}">
                        <input type="hidden" name="title" value="{{ $book['title'] ?? '' }}">
                        <input type="hidden" name="author" value="{{ $book['author_name'][0] ?? '' }}">
                        <input type="hidden" name="cover" value="https://covers.openlibrary.org/b/id/{{ $book['cover_i'] ?? '' }}-L.jpg">

                        <button type="submit" class="bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded shadow">
                            ➕ Add to My List
                        </button>
                    </form>
                </div>
            @empty
                <p class="text-gray-600 dark:text-gray-300 col-span-full">No results found. Try searching something else!</p>
            @endforelse
        </div>
    @endif
</div>
@endsection
