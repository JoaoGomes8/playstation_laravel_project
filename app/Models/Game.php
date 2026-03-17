<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Game extends Model
{
    protected $fillable = [
        'name',
        'cover_path',
        'release_date',
        'studio_id', // Chave estrangeira
    ];

    public function studio()
    {
        return $this->belongsTo(Studio::class);
    }
}
