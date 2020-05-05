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
    protected $appends = ['total_likes', 'liked_by_user', 'total_dislikes', 'disliked_by_user'];

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
     * Checks if current user liked movie.
     */
    public function getLikedByUserAttribute()
    {
        if (auth()->user() != null) {
            $user_id = auth()->user()->id;
            return $this->likes()->where('user_id', $user_id)->get()->isNotEmpty();
        } else {
            return false;
        }
    }

    /**
     * Get all of the dislikes for the movie.
     */
    public function getTotalDislikesAttribute()
    {
        return $this->dislikes()->count();
    }

    /**
     * Checks if current user disliked movie.
     */
    public function getDislikedByUserAttribute()
    {
        if (auth()->user() != null) {
            $user_id = auth()->user()->id;
            return $this->dislikes()->where('user_id', $user_id)->get()->isNotEmpty();
        } else {
            return false;
        }
    }
}
