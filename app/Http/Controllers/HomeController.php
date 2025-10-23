<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Category;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $totalBooks = Book::count();
        $totalCategories = Category::count();
        $recentBooks = Book::with(['category'])->latest()->take(5)->get();
        
        return view('dashboard', compact('totalBooks', 'totalCategories', 'recentBooks'));
    }
}
