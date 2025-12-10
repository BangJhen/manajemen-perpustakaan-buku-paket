<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BookDamage extends Model
{
    protected $fillable = [
        'book_id',
        'damage_type',
        'severity',
        'description',
        'location',
        'damage_date',
        'reported_by',
        'status',
        'repair_notes',
        'repair_date'
    ];

    protected $casts = [
        'damage_date' => 'date',
        'repair_date' => 'date'
    ];

    /**
     * Relasi ke Book
     */
    public function book()
    {
        return $this->belongsTo(Book::class);
    }

    /**
     * Scope untuk kerusakan yang belum diperbaiki
     */
    public function scopeUnrepaired($query)
    {
        return $query->where('status', 'rusak');
    }

    /**
     * Scope untuk kerusakan yang sudah diperbaiki
     */
    public function scopeRepaired($query)
    {
        return $query->where('status', 'diperbaiki');
    }

    /**
     * Helper untuk mendapatkan badge color berdasarkan severity
     */
    public function getSeverityBadgeClass()
    {
        return match($this->severity) {
            'ringan' => 'bg-warning',
            'sedang' => 'bg-orange',
            'berat' => 'bg-danger',
            default => 'bg-secondary'
        };
    }

    /**
     * Helper untuk mendapatkan badge color berdasarkan status
     */
    public function getStatusBadgeClass()
    {
        return match($this->status) {
            'rusak' => 'bg-danger',
            'diperbaiki' => 'bg-success',
            'tidak_dapat_diperbaiki' => 'bg-dark',
            default => 'bg-secondary'
        };
    }
}
