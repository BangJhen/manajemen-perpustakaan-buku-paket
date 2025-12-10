<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\BookDamage;
use Illuminate\Http\Request;

class BookDamageController extends Controller
{
    /**
     * Show form to add damage record for a book
     */
    public function create(Book $book)
    {
        return view('books.damages.create', compact('book'));
    }

    /**
     * Store a new damage record
     */
    public function store(Request $request, Book $book)
    {
        $request->validate([
            'damage_type' => 'required|string|max:255',
            'severity' => 'required|in:ringan,sedang,berat',
            'description' => 'required|string',
            'location' => 'nullable|string|max:255',
            'damage_date' => 'required|date',
            'reported_by' => 'nullable|string|max:255',
            'status' => 'required|in:rusak,diperbaiki,tidak_dapat_diperbaiki',
            'repair_notes' => 'nullable|string',
            'repair_date' => 'nullable|date|required_if:status,diperbaiki'
        ]);

        $book->damages()->create($request->all());

        // Update damaged_count di tabel books
        $book->increment('damaged_count');

        return redirect()->route('books.show', $book)
            ->with('success', 'Laporan kerusakan buku berhasil ditambahkan!');
    }

    /**
     * Show damage detail
     */
    public function show(Book $book, BookDamage $damage)
    {
        return view('books.damages.show', compact('book', 'damage'));
    }

    /**
     * Show form to edit damage record
     */
    public function edit(Book $book, BookDamage $damage)
    {
        return view('books.damages.edit', compact('book', 'damage'));
    }

    /**
     * Update damage record
     */
    public function update(Request $request, Book $book, BookDamage $damage)
    {
        $request->validate([
            'damage_type' => 'required|string|max:255',
            'severity' => 'required|in:ringan,sedang,berat',
            'description' => 'required|string',
            'location' => 'nullable|string|max:255',
            'damage_date' => 'required|date',
            'reported_by' => 'nullable|string|max:255',
            'status' => 'required|in:rusak,diperbaiki,tidak_dapat_diperbaiki',
            'repair_notes' => 'nullable|string',
            'repair_date' => 'nullable|date|required_if:status,diperbaiki'
        ]);

        $damage->update($request->all());

        return redirect()->route('books.show', $book)
            ->with('success', 'Laporan kerusakan berhasil diperbarui!');
    }

    /**
     * Delete damage record
     */
    public function destroy(Book $book, BookDamage $damage)
    {
        $damage->delete();

        // Update damaged_count di tabel books
        if ($book->damaged_count > 0) {
            $book->decrement('damaged_count');
        }

        return redirect()->route('books.show', $book)
            ->with('success', 'Laporan kerusakan berhasil dihapus!');
    }
}
