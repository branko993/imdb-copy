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
}
