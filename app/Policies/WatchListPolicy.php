<?php

namespace App\Policies;

use App\User;
use App\WatchList;
use Illuminate\Auth\Access\HandlesAuthorization;

class WatchListPolicy
{
    use HandlesAuthorization;

    /**
     * Create a new policy instance.
     *
     * @return void
     */
    public function __construct()
    {
    }

    /**
     * Determine watchList entity can be updated by the user.
     *
     * @param  User  $user
     * @param  watchList  $watchList
     * @return bool
     */
    public function update(User $user, watchList $watchList)
    {
        return $user->id === $watchList->user_id;
    }

    /**
     * Determine watchList entity can be deleted by the user.
     *
     * @param  User  $user
     * @param  watchList  $watchList
     * @return bool
     */
    public function delete(User $user, watchList $watchList)
    {
        return $user->id === $watchList->user_id;
    }
}
