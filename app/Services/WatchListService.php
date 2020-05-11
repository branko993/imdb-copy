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
     * @param int $id
     * @param User $user
     * @return Comments
     */
    public function markAsWatched(int $id, User $user)
    {
        $watchList = WatchList::where('id', $id)->firstOrFail();
        if ($user->can('update', $watchList)) {
            return tap($watchList)->update(['watched' => 1]);
        } else {
            return response(
                ['message' => 'Permission denied!'],
                403
            );
        }
    }

    /**
     * Unmarkes movie as watched
     *
     * @param int $id
     * @param User $user
     * @return Comments
     */
    public function unmarkAsWatched(int $id, User $user)
    {
        $watchList = WatchList::where('id', $id)->firstOrFail();
        if ($user->can('update', $watchList)) {
            return tap($watchList)->update(['watched' => 0]);
        } else {
            return response(
                ['message' => 'Permission denied!'],
                403
            );
        }
    }

    /**
     * removes movie from watch list
     *
     * @param int $id
     * @param User $user
     * @return void
     */
    public function remove(int $id, $user)
    {
        $watchList = WatchList::where('id', $id)->firstOrFail();
        if ($user->can('delete', $watchList)) {
            return tap($watchList)->delete();
        } else {
            return response(
                ['message' => 'Permission denied!'],
                403
            );
        }
    }
}
