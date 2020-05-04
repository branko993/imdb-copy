<?php

namespace App\Services;

use App\Movie;

class MoviesService
{
    /**
     * Find all movies from the DatabaseTable.
     *
     * @return \Illuminate\Http\Response
     */
    public function findAll()
    {
        return Movie::all();
    }

    /**
     * Find movie with specific id.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function findById($id)
    {
        return Movie::where('id', $id)->firstOrFail();
    }

    /**
     * Returns current page with specific size.
     *
     * @param int $size
     * @return \Illuminate\Http\Response
     */
    public function findCurrentPage($size)
    {
        return Movie::paginate($size);
    }

    /**
     * Creates new movie in Moves table.
     *
     * @param Movie $movie
     * @return \Illuminate\Http\Response
     */
    public function create($movie, $id)
    {
        $movie['user_id'] = $id;
        Movie::create($movie);
        return response('OK', 200);
    }
}
