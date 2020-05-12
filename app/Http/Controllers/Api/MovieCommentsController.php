<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\CreateCommentRequest;
use App\Services\CommentsService;

class MovieCommentsController extends Controller
{
    private $commentsService;

    public function __construct(CommentsService $commentsService)
    {
        $this->commentsService = $commentsService;
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store($id, CreateCommentRequest $request)
    {
        $comment = $request->validated();
        return $this->commentsService->create($comment, $id, auth()->user());
    }


    /**
     * Show comments for the current page for Movie.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function getCurrentPage($id, Request $request)
    {
        $size = $request->query('size');
        return $this->commentsService->findCurrentPage($id, $size, auth()->user());
    }
}
