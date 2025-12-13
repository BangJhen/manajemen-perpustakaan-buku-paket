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
        'published_year',
        'curriculum_year',
        'isbn',
        'description',
        'published_date',
        'pages',
        'language',
        'stock',
        'price',
        'condition',
        'damaged_count',
        'damage_notes',
        'category_id'
    ];

    protected $casts = [
        'published_date' => 'date',
        'price' => 'decimal:2'
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function damages()
    {
        return $this->hasMany(BookDamage::class);
    }

    // Accessor untuk menghitung damaged_count dari relasi damages
    public function getDamagedCountAttribute($value)
    {
        // Jika ada value dari database, gunakan itu (untuk backward compatibility)
        // Jika tidak, hitung dari relasi damages
        if ($this->relationLoaded('damages')) {
            return $this->damages->count();
        }
        return $value ?? 0;
    }

    // Accessor untuk menentukan kondisi otomatis
    public function getConditionAttribute($value)
    {
        // Jika ada laporan kerusakan, kondisi = rusak
        if ($this->relationLoaded('damages')) {
            return $this->damages->count() > 0 ? 'rusak' : 'baik';
        }
        return $value ?? 'baik';
    }

    // Helper methods for damage tracking
    public function isDamaged()
    {
        return $this->damages()->count() > 0;
    }

    public function getAvailableStock()
    {
        return $this->stock - $this->damages()->count();
    }

    public function scopeDamaged($query)
    {
        return $query->whereHas('damages');
    }

    public function scopeGoodCondition($query)
    {
        return $query->whereDoesntHave('damages');
    }
}
