<?php

namespace App\Services;

use App\Genre;

class GenreService
{
    /**
     * Find all movies from the DatabaseTable.
     *
     * @return \Illuminate\Http\Response
     */
    public function findAll()
    {
        return Genre::all();
    }

    /**
     * Find movie from name.
     *
     * @param string $title
     * @return \Illuminate\Http\Response
     */
    public function getByTitle(string $name)
    {
        return Genre::where('name', 'like' , $name)->firstOrFail();
    }
}
