<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Author extends Model
{
    protected $fillable = [
        'name',
        'biography',
        'birth_date',
        'nationality'
    ];

    protected $casts = [
        'birth_date' => 'date'
    ];

    public function books()
    {
        return $this->hasMany(Book::class);
    }
}
