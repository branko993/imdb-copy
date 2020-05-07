<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Movie extends Model
{
    protected $fillable = [
        'title', 'description', 'image_url', 'genre_id', 'user_id'
    ];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array
     */
    protected $appends = ['total_likes', 'total_dislikes'];

    function likes()
    {
        return $this->hasMany(Like::class);
    }

    function dislikes()
    {
        return $this->hasMany(Dislike::class);
    }

    /**
     * Get all of the likes for the movie.
     */
    public function getTotalLikesAttribute()
    {
        return $this->likes()->count();
    }


    /**
     * Get all of the dislikes for the movie.
     */
    public function getTotalDislikesAttribute()
    {
        return $this->dislikes()->count();
    }

    public function scopeApplyMovieFilters($query, $request)
    {
        if ($request->has('title')) {
            $query->whereRaw("LOWER(title) LIKE '%" . strtolower($request->query('title')) . "%'");
        }
        if ($request->has('genreId')) {
            $query->where('genre_id', 'LIKE', '%' . $request->query('genreId') . '%');
        }
    }
}
