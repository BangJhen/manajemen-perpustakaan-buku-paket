<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Category;
use Illuminate\Http\Request;

class BookController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $books = Book::with(['category'])->paginate(10);
        return view('books.index', compact('books'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::all();
        return view('books.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'subject' => 'required|string|max:100',
            'grade_level' => 'required|string|max:10',
            'semester' => 'nullable|string|max:10',
            'curriculum_type' => 'required|string|max:100',
            'book_type' => 'required|string|max:50',
            'publisher' => 'required|string|max:100',
            'curriculum_year' => 'nullable|integer|min:2000|max:2030',
            'isbn' => 'nullable|string|unique:books',
            'description' => 'nullable|string',
            'published_date' => 'nullable|date',
            'pages' => 'nullable|integer|min:1',
            'language' => 'required|string',
            'stock' => 'required|integer|min:0',
            'condition' => 'required|in:baik,rusak',
            'damaged_count' => 'nullable|integer|min:0|lte:stock',
            'damage_notes' => 'nullable|string',
            'category_id' => 'required|exists:categories,id'
        ]);

        Book::create($request->all());
        return redirect()->route('books.index')->with('success', 'Buku berhasil ditambahkan!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Book $book)
    {
        return view('books.show', compact('book'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Book $book)
    {
        $categories = Category::all();
        return view('books.edit', compact('book', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Book $book)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'subject' => 'required|string|max:100',
            'grade_level' => 'required|string|max:10',
            'semester' => 'nullable|string|max:10',
            'curriculum_type' => 'required|string|max:100',
            'book_type' => 'required|string|max:50',
            'publisher' => 'required|string|max:100',
            'curriculum_year' => 'nullable|integer|min:2000|max:2030',
            'isbn' => 'nullable|string|unique:books,isbn,' . $book->id,
            'description' => 'nullable|string',
            'published_date' => 'nullable|date',
            'pages' => 'nullable|integer|min:1',
            'language' => 'required|string',
            'stock' => 'required|integer|min:0',
            'condition' => 'required|in:baik,rusak',
            'damaged_count' => 'nullable|integer|min:0|lte:stock',
            'damage_notes' => 'nullable|string',
            'category_id' => 'required|exists:categories,id'
        ]);

        $book->update($request->all());
        return redirect()->route('books.index')->with('success', 'Buku berhasil diperbarui!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Book $book)
    {
        $book->delete();
        return redirect()->route('books.index')->with('success', 'Buku berhasil dihapus!');
    }

    /**
     * Display a listing of damaged books.
     */
    public function damaged()
    {
        $books = Book::damaged()->with(['category'])->paginate(10);
        return view('books.damaged', compact('books'));
    }
}
