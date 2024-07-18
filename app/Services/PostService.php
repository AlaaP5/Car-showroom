<?php

namespace App\Services;

use App\Models\Comment;
use App\Models\Post;

class PostService
{
    public function store($request)
    {
        try{
        $input = $request->all();

        $image = $request->file('image')->getClientOriginalName();
        $path = $request->file('image')->storeAs('posts', $image, 'files');
        $input['image'] = $path;

        Post::create($input);
        return response()->json(['message' => 'The Post has been added Successfully'], 201);
        }
        catch (\Exception $e){
            return response()->json(['message' =>$e->getMessage()],422);
        }
    }


    public function fetchAll()
    {
        $posts = Post::get();
        foreach ($posts as $post) {
            $post->image = asset('files/' . $post->image);
        }
        if (!count($posts)) {
            return response()->json(['message' => 'not found'], 404);
        }
        return response()->json(['data' => $posts], 200);
    }


    public function get($id)
    {
        $post = Post::where('id', $id)->first();
        if (empty($post)) {
            return response()->json(['message' => 'not found'], 404);
        }
        $post->image = asset('files/' . $post->image);
        return response()->json(['data' => $post], 200);
    }


    public function search($name)
    {
        $search = Post::where('title', 'like', '%' . $name . '%')->orderBy("title")->get();
        if (!count($search)) {
            return response()->json(['message' => 'not found'], 404);
        }
        foreach ($search as $se) {
            $se->image = asset('files/' . $se->image);
        }
        return response()->json(['data' => $search], 200);
    }


    public function update($id, $request)
    {
        $post = Post::find($id);

        if ($request->image) {
            $image = $request->file('image')->getClientOriginalName();
            $path = $request->file('image')->storeAs('posts', $image, 'files');
        }
        $post->update([
            'title' => ($request->title) ? $request->title : $post->title,
            'description' => ($request->description) ? $request->description : $post->description,
            'image' => ($request->image) ? $path : $post->image,
            'date' => ($request->date) ? $request->date : $post->date
        ]);
        return response()->json(['message' => 'Post updated successfully'], 200);
    }


    public function delete($id)
    {
        $post = Post::find($id);
        if (empty($post)) {
            return response()->json(['message' => 'this Post not found'], 404);
        }
        $comments=Comment::where('post_id',$post->id)->get();
        foreach ($comments as $comment) {
        $comment->delete();
        }
        $post->delete();
        return response()->json(['message' => 'Post has been deleted successfully'], 200);
    }
}
