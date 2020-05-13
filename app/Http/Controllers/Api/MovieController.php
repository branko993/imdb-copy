<?php

namespace App\Http\Controllers\Api;

use App\Events\MovieCreation;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\CreateMovieRequest;
use App\Movie;
use App\Services\DislikeService;
use App\Services\MoviesService;
use App\Services\LikeService;
use Illuminate\Console\Scheduling\Event;

class MovieController extends Controller
{
    private $movieService;
    private $likeService;
    private $dislikeService;

    public function __construct(MoviesService $movieService, LikeService $likeService, DislikeService $dislikeService)
    {
        $this->movieService = $movieService;
        $this->likeService = $likeService;
        $this->dislikeService = $dislikeService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return $this->movieService->findAll(auth()->user());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateMovieRequest $request)
    {
        $movieForCreation = $request->validated();
        $movie = $this->movieService->create($movieForCreation, auth()->user());
        MovieCreation::dispatch($movie);
        return $movie;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $movie = $this->movieService->findByid($id, auth()->user());
        $movie->increment('views');
        return $movie;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    /**
     * Show all movies for the current page.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function getCurrentPage(Request $request)
    {
        $size = $request->query('size');
        $title = $request->query('title');
        $genre = $request->query('genreId');
        return $this->movieService->findCurrentPage($size, $title, $genre, auth()->user());
    }

    /**
     * Like functionality for current user.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function likeMovie($id)
    {
        $movie = $this->movieService->findByid($id, auth()->user());
        switch ($movie) {
            case $movie->likes_count > 0:
                return $this->likeService->destroy(auth()->user(), $movie);
            case $movie->dislikes_count > 0:
                return $this->likeService->dislikeIntoLike(auth()->user(), $movie);
            default:
                return $this->likeService->create(auth()->user(), $movie);
        }
    }

    /**
     * Dislike functionality for current user.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function dislikeMovie($id)
    {
        $movie = $this->movieService->findByid($id, auth()->user());
        switch ($movie) {
            case $movie->likes_count > 0:
                return $this->dislikeService->likeIntoDislike(auth()->user(), $movie);
            case $movie->dislikes_count > 0:
                return $this->dislikeService->destroy(auth()->user(), $movie);
            default:
                return $this->dislikeService->create(auth()->user(), $movie);
        }
    }

    /**
     * Returns list of top 10 liked movies
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function getPopularMovies()
    {
        return $this->movieService->getTopTenMovies();
    }

     /**
     * Returns list of top 10 related movies
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function getRelatedMovies(Movie $movie)
    {
        return $this->movieService->getRelatedMovies($movie);
    }
}
