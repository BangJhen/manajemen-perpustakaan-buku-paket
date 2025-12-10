<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Book;
use App\Models\Category;

class ReportController extends Controller
{
    public function index(Request $request)
    {
        $query = Book::with('category');

        // Filter by category
        if ($request->filled('category_id')) {
            $query->where('category_id', $request->category_id);
        }

        // Filter by subject
        if ($request->filled('subject')) {
            $query->where('subject', 'like', '%' . $request->subject . '%');
        }

        // Filter by grade level
        if ($request->filled('grade_level')) {
            $query->where('grade_level', $request->grade_level);
        }

        // Filter by curriculum type
        if ($request->filled('curriculum_type')) {
            $query->where('curriculum_type', $request->curriculum_type);
        }

        // Filter by condition
        if ($request->filled('condition')) {
            $query->where('condition', $request->condition);
        }

        // Filter by publisher
        if ($request->filled('publisher')) {
            $query->where('publisher', 'like', '%' . $request->publisher . '%');
        }

        // Filter by published year
        if ($request->filled('published_year')) {
            $query->where('published_year', $request->published_year);
        }

        // Filter by date range
        if ($request->filled('date_from')) {
            $query->whereDate('created_at', '>=', $request->date_from);
        }
        if ($request->filled('date_to')) {
            $query->whereDate('created_at', '<=', $request->date_to);
        }

        // Sorting
        $sortBy = $request->get('sort_by', 'title');
        $sortOrder = $request->get('sort_order', 'asc');
        $query->orderBy($sortBy, $sortOrder);

        $books = $query->get();
        $categories = Category::all();

        // Calculate statistics
        $totalBooks = $books->count();
        $totalStock = $books->sum('stock');
        $totalValue = $books->sum(function($book) {
            return $book->stock * ($book->price ?? 0);
        });
        $damagedBooks = $books->where('condition', 'rusak')->count();
        $totalDamaged = $books->sum('damaged_count');

        return view('reports.index', compact(
            'books', 
            'categories', 
            'totalBooks', 
            'totalStock', 
            'totalValue', 
            'damagedBooks',
            'totalDamaged'
        ));
    }

    public function print(Request $request)
    {
        $query = Book::with('category');

        // Apply same filters as index
        if ($request->filled('category_id')) {
            $query->where('category_id', $request->category_id);
        }
        if ($request->filled('subject')) {
            $query->where('subject', 'like', '%' . $request->subject . '%');
        }
        if ($request->filled('grade_level')) {
            $query->where('grade_level', $request->grade_level);
        }
        if ($request->filled('curriculum_type')) {
            $query->where('curriculum_type', $request->curriculum_type);
        }
        if ($request->filled('condition')) {
            $query->where('condition', $request->condition);
        }
        if ($request->filled('publisher')) {
            $query->where('publisher', 'like', '%' . $request->publisher . '%');
        }
        if ($request->filled('published_year')) {
            $query->where('published_year', $request->published_year);
        }
        if ($request->filled('date_from')) {
            $query->whereDate('created_at', '>=', $request->date_from);
        }
        if ($request->filled('date_to')) {
            $query->whereDate('created_at', '<=', $request->date_to);
        }

        $sortBy = $request->get('sort_by', 'title');
        $sortOrder = $request->get('sort_order', 'asc');
        $query->orderBy($sortBy, $sortOrder);

        $books = $query->get();

        // Calculate statistics
        $totalBooks = $books->count();
        $totalStock = $books->sum('stock');
        $totalValue = $books->sum(function($book) {
            return $book->stock * ($book->price ?? 0);
        });
        $damagedBooks = $books->where('condition', 'rusak')->count();
        $totalDamaged = $books->sum('damaged_count');

        return view('reports.print', compact(
            'books', 
            'totalBooks', 
            'totalStock', 
            'totalValue', 
            'damagedBooks',
            'totalDamaged',
            'request'
        ));
    }
}
