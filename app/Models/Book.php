<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    protected $fillable = [
        'title',
        'subject',
        'grade_level',
        'semester',
        'curriculum_type',
        'book_type',
        'publisher',
        'curriculum_year',
        'isbn',
        'description',
        'published_date',
        'pages',
        'language',
        'stock',
        'category_id'
    ];

    protected $casts = [
        'published_date' => 'date'
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
