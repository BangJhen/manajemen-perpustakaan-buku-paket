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
        'condition',
        'damaged_count',
        'damage_notes',
        'category_id'
    ];

    protected $casts = [
        'published_date' => 'date'
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    // Helper methods for damage tracking
    public function isDamaged()
    {
        return $this->condition === 'rusak';
    }

    public function getAvailableStock()
    {
        return $this->stock - $this->damaged_count;
    }

    public function scopeDamaged($query)
    {
        return $query->where('condition', 'rusak')->orWhere('damaged_count', '>', 0);
    }

    public function scopeGoodCondition($query)
    {
        return $query->where('condition', 'baik')->where('damaged_count', 0);
    }
}
