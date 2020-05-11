<?php

namespace App\Services;

use App\Comments;
use App\User;
use App\WatchList;
use Illuminate\Auth\Access\Gate;

class WatchListService
{
    /**
     * Find all movies from the DatabaseTable.
     *
     * @return \Illuminate\Http\Response
     */
    public function findAll($user)
    {
        return WatchList::with('movie')->where('user_id', $user->id)->get();
    }

    /**
     * adds new movie in watchlist.
     *
     * @param int $movie_id
     * @param User $user
     * @return Comments
     */
    public function create(int $movie_id, User $user): WatchList
    {
        $watchList['user_id'] = $user->id;
        $watchList['movie_id'] = $movie_id;
        return WatchList::create($watchList)->fresh();
    }

    /**
     * Markes movie as watched
     *
     * @param WatchList $watchList
     * @param User $user
     * @return Comments
     */
    public function markAsWatched(WatchList $watchList)
    {
        return tap($watchList)->update(['watched' => 1]);
    }

    /**
     * Unmarkes movie as watched
     *
     * @param WatchList $watchList
     * @param User $user
     * @return Comments
     */
    public function unmarkAsWatched(WatchList $watchList)
    {
        return tap($watchList)->update(['watched' => 0]);
    }

    /**
     * removes movie from watch list
     *
     * @param WatchList $watchList
     * @param User $user
     * @return void
     */
    public function remove(WatchList $watchList)
    {
        return tap($watchList)->delete();
    }
}
