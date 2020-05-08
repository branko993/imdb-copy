<?php

namespace App\Services;

use App\Comments;
use App\User;
use App\WatchList;

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
        return WatchList::create($watchList);
    }

    /**
     * Markes movie as watched
     *
     * @param int $id
     * @return Comments
     */
    public function markAsWatched(int $id)
    {
        return WatchList::where('id', $id)->update(array('watched' => 1));
    }

    /**
     * Unmarkes movie as watched
     *
     * @param int $id
     * @return Comments
     */
    public function unmarkAsWatched(int $id)
    {
        return WatchList::where('id', $id)->update(array('watched' => 0));
    }

    /**
     * removes movie from watch list
     *
     * @param int $id
     * @param User $user
     * @return Comments
     */
    public function remove(int $id)
    {
        WatchList::where('id', $id)->delete();
        return response(null);
    }
}
