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

    function watchList()
    {
        return $this->hasOne(WatchList::class)->latest();
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

    public function scopeFilterByTitleAndGenre($query, $title, $genre)
    {
        if ($title != null) {
            $query->whereRaw("LOWER(title) LIKE '%" . strtolower($title) . "%'");
        }
        if ($genre != null) {
            $query->where('genre_id', 'LIKE', '%' . $genre . '%');
        }
    }

    public function scopeGetAllQueryRelations($query, $user)
    {
        $query->withCount(['likes' => function ($query)  use ($user) {
            return $query->where('user_id', $user->id);
        }])->withCount(['dislikes' => function ($query)  use ($user) {
            return $query->where('user_id', $user->id);
        }])->with(['watchList' => function ($query)  use ($user) {
            return $query->where('user_id', $user->id);
        }]);
    }
}
