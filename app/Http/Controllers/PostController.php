<?php

namespace App\Http\Controllers;

use App\Http\Requests\PostValidate;
use App\Services\PostService;
use Illuminate\Http\Request;

class PostController extends Controller
{
    protected $Post;
    public function __construct(PostService $post) {
        $this->Post = $post;
    }

    public function store(PostValidate $request)
    {
        return $this->Post->store($request);
    }

    public function fetchAll()
    {
        return $this->Post->fetchAll();
    }

    public function fetch($id)
    {
        return $this->Post->get($id);
    }

    public function search($name = '')
    {
        return $this->Post->search($name);
    }

    public function deletePost($id)
    {
        return $this->Post->delete($id);
    }

    public function updatePost($id,Request $request)
    {
        return $this->Post->update($id, $request);
    }
}
