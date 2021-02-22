<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Anime extends Model
{
    use HasFactory;

    protected $fillable = [
        'title', 'description', 'episodes', 'genre'
    ];

    protected $attributes = [
        'episodes' => 0,
        'genre' => 'N/A'
    ];

    public function authors()
    {
        return $this->belongsTo(Post::class);
    }
}
