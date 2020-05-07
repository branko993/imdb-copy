<?php

namespace App\Services;

use App\Comments;
use App\Movie;
use App\User;

class CommentsService
{

    /**
     * Returns current page with specific size.
     *
     * @param  int  $size
     * @return \Illuminate\Http\Response
     */
    public function findCurrentPage($size)
    {
        return Comments::with('user')->paginate($size);
    }

    /**
     * Creates new movie in Moves table.
     *
     * @param Comments $comment
     * @param int $id
     * @param User $user
     * @return Comments
     */
    public function create(array $comment, $id, User $user): Comments
    {
        $comment['user_id'] = $user->id;
        $comment['movie_id'] = $id;
        return Comments::create($comment);
    }
}
