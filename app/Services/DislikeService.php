<?php

namespace App\Services;

use App\Dislike;
use App\Like;
use App\Movie;
use App\User;
use Illuminate\Http\JsonResponse;

class DislikeService
{
    /**
     * Creates new like for a movie in Likes table.
     *
     * @param User $user
     * @param User $movie
     * @return Dislike
     */
    public function create(User $user, Movie $movie): Dislike
    {
        $dislike = array(
            'movie_id' => $movie->id,
            'user_id' => $user->id
        );

        return Dislike::create($dislike);
    }

    /**
     * Deletes dislikelike for a movie in Dislikes table.
     *
     * @param User $user
     * @param User $movie
     * @return Response
     */
    public function destroy(User $user, Movie $movie)
    {
        Dislike::where([['movie_id', '=', $movie->id], ['user_id', '=', $user->id]])->delete();

        return response(null);
    }

    /**
     * Turns like into dislike for current movie.
     *
     * @param User $user
     * @param User $movie
     * @return Dislike
     */
    public function likeIntoDislike(User $user, Movie $movie): Dislike
    {
        Like::where('movie_id', '=', $movie->id)->where('user_id', '=', $user->id)->delete();
        return $this->create($user, $movie);
    }
}
