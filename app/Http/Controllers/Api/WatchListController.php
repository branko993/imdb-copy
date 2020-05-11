<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Services\WatchListService;

class WatchListController extends Controller
{
    private $watchListService;

    public function __construct(WatchListService $watchListService)
    {
        $this->watchListService = $watchListService;
    }

    /**
     * Gets watchList for current user
     *
     * @return \Illuminate\Http\Response
     */
    public function get()
    {
        return $this->watchListService->findAll(auth()->user());
    }

    /**
     * Adds movie in current user's watchList
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function add(Request $request)
    {
        return $this->watchListService->create($request->movie_id, auth()->user());
    }

    /**
     * Updates watchlist movie to watched
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function markAsWatched($id)
    {
        return $this->watchListService->markAsWatched($id, auth()->user());
    }

    /**
     * Updates watchlist movie to watched
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function unmarkAsWatched($id)
    {
        return $this->watchListService->unmarkAsWatched($id, auth()->user());
    }

    /**
     * Deletes movie from watchList
     *
     * @param int $id
     * @return Comments
     */
    public function remove(int $id)
    {
        return $this->watchListService->remove($id, auth()->user());
    }
}
