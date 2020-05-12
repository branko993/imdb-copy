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
            return Movie::getAllQueryRelations($user)->get();
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
            return Movie::getAllQueryRelations($user)->where('id', $id)->firstOrFail();
        } else {
            return Movie::where('id', $id)->firstOrFail();
        }
    }

    /**
     * Returns current page with specific size.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  User  $user
     * @return \Illuminate\Http\Response
     */
    public function findCurrentPage($size, $title, $genre, $user)
    {
        if ($user != null) {
            return Movie::getAllQueryRelations($user)->filterByTitleAndGenre($title, $genre)->paginate($size);
        } else {
            return Movie::filterByTitleAndGenre($title, $genre)->paginate($size);
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

    /**
     * Find top 10 most liked movies for Movies table
     *
     * @return \Illuminate\Http\Response
     */
    public function getTopTenMovies()
    {
        return Movie::all()->SortByDesc('total_likes')->values()->take(10);
    }
}
