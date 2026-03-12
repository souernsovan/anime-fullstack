<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Anime extends Model
{
    use HasFactory;

    // Allow mass assignment for these fields
    protected $fillable = [
        'title',
        'description',
        'studio',
        'release_year',
        'rating',
        'poster'
    ];

    // Optional: relation to episodes
    public function episodes()
    {
        return $this->hasMany(Episode::class);
    }
}