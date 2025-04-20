@extends('layouts.app')

@section('content')
<div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    <h1 class="text-3xl font-bold text-gray-800 dark:text-white mb-6">📚 My Book List</h1>

    @if(session('success'))
        <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 rounded mb-6 dark:bg-green-900 dark:text-green-200">
            {{ session('success') }}
        </div>
    @endif

    @forelse ($books as $book)
        <div class="bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 p-6 rounded-2xl mb-6 shadow-sm hover:shadow-md transition">
            <div class="flex flex-col sm:flex-row items-start gap-6">
                @if($book->cover_url)
                    <img src="{{ $book->cover_url }}" alt="Cover" class="w-32 h-auto rounded shadow">
                @endif

                <div class="flex-1">
                    <h2 class="text-2xl font-semibold text-gray-900 dark:text-white">{{ $book->title }}</h2>
                    <p class="text-sm text-gray-600 dark:text-gray-400 mb-2">by {{ $book->author }} • <span class="italic">{{ $book->format->name }}</span></p>

                    @if($book->opinion)
                        <p class="text-gray-800 dark:text-gray-300 italic mb-2">"{{ $book->opinion }}"</p>
                    @endif

                    @if($book->image_path)
                        <img src="{{ Storage::disk('s3')->url($book->image_path) }}" alt="Uploaded Image" class="w-32 mt-2 rounded border border-gray-300 dark:border-gray-600">
                    @endif
                </div>
            </div>
        </div>
    @empty
        <p class="text-gray-700 dark:text-gray-300">You haven’t added any books yet. Head over to <a href="{{ route('books.search') }}" class="text-indigo-600 dark:text-indigo-400 underline">search</a> to get started!</p>
    @endforelse
</div>
@endsection
