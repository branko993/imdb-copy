<?php

namespace App\Services;

use App\Movie;
use App\User;

class MoviesService
{
    /**
     * Find all movies from the DatabaseTable.
     *
     * @return \Illuminate\Http\Response
     */
    public function findAll($user)
    {
        if ($user != null) {
            return Movie::withCount(['likes' => function ($query)  use ($user) {
                return $query->where('user_id', $user->id);
            }])->withCount(['dislikes' => function ($query)  use ($user) {
                return $query->where('user_id', $user->id);
            }])->get();
        } else {
            return Movie::all();
        }
    }

    /**
     * Find movie with specific id.
     *
     * @param int $id
     * @return Movie
     */
    public function findById($id, $user): Movie
    {
        if ($user != null) {
            return Movie::withCount(['likes' => function ($query)  use ($user) {
                return $query->where('user_id', $user->id);
            }])->withCount(['dislikes' => function ($query)  use ($user) {
                return $query->where('user_id', $user->id);
            }])->where('id', $id)->firstOrFail();
        } else {
            return Movie::where('id', $id)->firstOrFail();
        }
    }

    /**
     * Returns current page with specific size.
     *
     * @param int $size
     * @return \Illuminate\Http\Response
     */
    public function findCurrentPage($size, $user)
    {
        if ($user != null) {
            return Movie::withCount(['likes' => function ($query)  use ($user) {
                return $query->where('user_id', $user->id);
            }])->withCount(['dislikes' => function ($query)  use ($user) {
                return $query->where('user_id', $user->id);
            }])->paginate($size);
        } else {
            return Movie::paginate($size);
        }
    }

    /**
     * Creates new movie in Moves table.
     *
     * @param Movie $movie
     * @return Movie
     */
    public function create(array $movie, User $user): Movie
    {
        $movie['user_id'] = $user->id;
        return Movie::create($movie);
    }
}