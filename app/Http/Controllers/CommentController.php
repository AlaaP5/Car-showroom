<?php

namespace App\Http\Controllers;

use App\Http\Requests\CommentValidate;
use App\Services\CommentService;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    protected $Comment;
    public function __construct(CommentService $Comment)
    {
        $this->Comment = $Comment;
    }

    public function store(CommentValidate $request)
    {
        return $this->Comment->store($request);
    }

    public function fetch($id)
    {
        return $this->Comment->get($id);
    }

    public function updateComment($id,Request $request)
    {
        return $this->Comment->update($id, $request);
    }

    public function deleteComment($id)
    {
        return $this->Comment->delete($id);
    }

    public function CommentsOfPost($id)
    {
        return $this->Comment->CommentsOfPost($id);
    }
}
