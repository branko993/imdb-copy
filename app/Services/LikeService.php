<?php

namespace App\Services;

use App\Dislike;
use App\Like;
use App\Movie;
use App\User;
use Illuminate\Http\JsonResponse;

class LikeService
{
    /**
     * Creates new like for a movie in Likes table.
     *
     * @param User $user
     * @param User $movie
     * @return Like
     */
    public function create(User $user, Movie $movie): Like
    {
        $like = array(
            'movie_id' => $movie->id,
            'user_id' => $user->id
        );

        return Like::create($like);
    }

    /**
     * Deletes like for a movie in Likes table.
     *
     * @param User $user
     * @param User $movie
     * @return Response
     */
    public function destroy(User $user, Movie $movie)
    {
        Like::where([['movie_id', '=', $movie->id], ['user_id', '=', $user->id]])->delete();

        return response(null);
    }

    /**
     * Turns dislike into like for current movie.
     *
     * @param User $user
     * @param User $movie
     * @return Like
     */
    public function dislikeIntoLike(User $user, Movie $movie): Like
    {
        Dislike::where('movie_id', '=', $movie->id)->where('user_id', '=', $user->id)->delete();
        return $this->create($user, $movie);
    }
}
