<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use App\Models\Format;
use App\Models\Book;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class BookController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $books = Book::with('format')->where('user_id', Auth::id())->latest()->get();

        return view('books.index', compact('books'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        $formats = Format::all();

        return view('books.create', [
            'title' => $request->input('title'),
            'author' => $request->input('author'),
            'cover' => $request->input('cover'),
            'formats' => $formats
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'author' => 'required|string|max:255',
            'cover_url' => 'nullable|string',
            'format_id' => 'required|exists:formats,id',
            'opinion' => 'nullable|string',
            'image' => 'nullable|image|max:2048', // Max 2MB
        ]);

        $imagePath = null;

        if ($request->hasFile('image') && $request->file('image')->isValid()) {
            $imagePath = $request->file('image')->store('', 's3'); 
        }



        Book::create([
            'title' => $validated['title'],
            'author' => $validated['author'],
            'cover_url' => $validated['cover_url'],
            'format_id' => $validated['format_id'],
            'opinion' => $validated['opinion'],
            'image_path' => $imagePath,
            'user_id' => Auth::id(),
        ]);

        return redirect()->route('books.index')->with('success', 'Book added to your list!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    public function search(Request $request)
    {
        $query = $request->input('q');

        $results = [];

        if ($query) {
            $response = Http::get('https://openlibrary.org/search.json', [
                'q' => $query,
            ]);

            $results = $response->json()['docs'] ?? [];
        }

        return view('books.search', compact('results', 'query'));
    }
}
