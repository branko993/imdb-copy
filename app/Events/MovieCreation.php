<?php

namespace App\Events;

use App\Movie;
use Illuminate\Queue\SerializesModels;
use Illuminate\Foundation\Events\Dispatchable;

class MovieCreation
{
    use Dispatchable, SerializesModels;

    public $movie;
    
    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(Movie $movie)
    {
        $this->movie = $movie;
    }
}
