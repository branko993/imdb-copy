<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Services\WatchListService;
use App\WatchList;

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
     * @param WatchList $watchList
     * @return \Illuminate\Http\Response
     */
    public function markAsWatched(WatchList $watchList)
    {
        return $this->watchListService->markAsWatched($watchList);
    }

    /**
     * Updates watchlist movie to watched
     * @param Request $request
     * @param WatchList $watchList
     * @return \Illuminate\Http\Response
     */
    public function unmarkAsWatched(WatchList $watchList)
    {
        return $this->watchListService->unmarkAsWatched($watchList);
    }

    /**
     * Deletes movie from watchList
     *
     * @param WatchList $watchList
     * @return Comments
     */
    public function remove(WatchList $watchList)
    {
        return $this->watchListService->remove($watchList);
    }
}
