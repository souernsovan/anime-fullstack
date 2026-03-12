<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Episode extends Model
{
    use HasFactory;

    protected $fillable = [
        'anime_id',
        'title',
        'episode_number',
        'video_url',
        'thumbnail',
    ];

    // Relation: Episode belongs to an anime
    public function anime()
    {
        return $this->belongsTo(Anime::class);
    }
}