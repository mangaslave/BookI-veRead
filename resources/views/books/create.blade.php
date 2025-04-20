@extends('layouts.app')

@section('content')
<div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    <h1 class="text-3xl font-bold text-gray-800 dark:text-white mb-6">➕ Add Book to My List</h1>

    <form action="{{ route('books.store') }}" method="POST" enctype="multipart/form-data" class="bg-white dark:bg-gray-800 p-6 rounded-xl shadow space-y-6 border border-gray-200 dark:border-gray-700">
        @csrf

        <input type="hidden" name="title" value="{{ old('title', $title) }}">
        <input type="hidden" name="author" value="{{ old('author', $author) }}">
        <input type="hidden" name="cover_url" value="{{ old('cover', $cover) }}">

        <div>
            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">📖 Title</label>
            <p class="mt-1 text-lg font-semibold text-gray-900 dark:text-white">{{ $title }}</p>
        </div>

        <div>
            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">✍️ Author</label>
            <p class="mt-1 text-lg text-gray-800 dark:text-gray-200">{{ $author }}</p>
        </div>

        <div>
            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">🖼️ Cover Image</label>
            @if($cover)
                <img src="{{ $cover }}" alt="Book Cover" class="mt-2 w-32 rounded border border-gray-300 dark:border-gray-600">
            @else
                <p class="text-gray-500 dark:text-gray-400 mt-1">No cover available.</p>
            @endif
        </div>

        <div>
            <label for="format_id" class="block text-sm font-medium text-gray-700 dark:text-gray-300">📦 Format</label>
            <select name="format_id" id="format_id" class="mt-1 block w-full px-4 py-2 rounded border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-900 text-gray-900 dark:text-white focus:ring-indigo-500 focus:border-indigo-500">
                @foreach ($formats as $format)
                    <option value="{{ $format->id }}">{{ $format->name }}</option>
                @endforeach
            </select>
        </div>

        <div>
            <label for="opinion" class="block text-sm font-medium text-gray-700 dark:text-gray-300">📝 Your Thoughts</label>
            <textarea name="opinion" id="opinion" rows="5" placeholder="What did you think about it?" class="mt-1 block w-full px-4 py-2 rounded border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-900 text-gray-900 dark:text-white focus:ring-indigo-500 focus:border-indigo-500">{{ old('opinion') }}</textarea>
        </div>

        <div>
            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">📂 Optional Upload (notes, photo, etc)</label>
            <input type="file" name="image" accept="image/*" class="mt-1 block w-full px-4 py-2 rounded border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-900 text-gray-900 dark:text-white">
        </div>

        <div class="pt-4">
            <button type="submit" class="w-full bg-green-600 hover:bg-green-700 text-white font-semibold px-4 py-2 rounded shadow transition">
                💾 Save Book
            </button>
        </div>
    </form>
</div>
@endsection
