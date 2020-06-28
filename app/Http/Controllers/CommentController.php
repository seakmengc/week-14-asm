<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateCommentRequest;
use App\Http\Requests\UpdateCommentRequest;
use App\Repositories\CommentRepository;
use App\Http\Controllers\AppBaseController;
use App\Models\Comment;
use Illuminate\Http\Request;
use Flash;
use Response;

class CommentController extends Controller
{
    /**
     * Store a newly created Comment in storage.
     *
     * @param CreateCommentRequest $request
     *
     * @return Response
     */
    public function store(CreateCommentRequest $request)
    {
        $input = $request->all();

        $comment = Comment::create($input);

        Flash::success('Comment saved successfully.');

        return redirect(route('posts.show', $comment->post));
    }
}
