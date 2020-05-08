<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Dislike extends Model
{
    protected $fillable = [
        'user_id', 'movie_id'
    ];

    public function movie()
    {
        return $this->belongsTo(Movie::class);
    }
}
