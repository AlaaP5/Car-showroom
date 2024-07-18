<?php

namespace App\Services;

use App\Models\Comment;
use App\Models\Post;
use Illuminate\Support\Facades\Auth;

class CommentService
{
    public function store($request)
    {
        $input = $request->all();
        $id = Auth::id();
        $input['user_id'] = $id;
        Comment::create($input);
        return response()->json(['message' => 'The Comment has been added Successfully'], 201);
    }


    public function get($id)
    {
        $comment = Comment::where('id', $id)->first();
        if (empty($comment)) {
            return response()->json(['message' => 'not found'], 404);
        }
        return response()->json(['data' => $comment], 200);
    }


    public function update($id, $request)
    {
        $user_id = Auth::id();
        $comment = Comment::where('id',$id)->where('user_id',$user_id)->first();
        if (empty($comment)) {
            return response()->json(['message' => 'not found'], 404);
        }
        $comment->update([
            'body' => ($request->body) ? $request->body : $comment->body
        ]);
        return response()->json(['message' => 'Comment updated successfully'], 200);

    }


    public function delete($id)
    {
        $user_id = Auth::id();
        $comment = Comment::find($id);
        if (empty($comment)) {
            return response()->json(['message' => 'not found'], 404);
        }
        if ($comment->user_id == $user_id) {
            $comment->delete();
            return response()->json(['Comment deleted successfully'], 200);
        }
        return response()->json(['message' => 'you can not delete this a comment'], 403);
    }


    public function CommentsOfPost($id)
    {
        $post = Post::find($id);
        if (empty($post)) {
            return response()->json(['message' => 'This post is not found'], 404);
        }
        $comments = Comment::where('post_id', $id)->get();
        if (!count($comments)) {
            return response()->json(['message' => 'not found any comment'], 404);
        }
        return response()->json(['data' => $comments], 200);
    }
}
