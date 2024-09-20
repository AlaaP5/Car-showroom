<?php

namespace App\Services;

use App\Interfaces\PostRepositoryInterface;

class PostService
{
    protected $postRepository;

    public function __construct(PostRepositoryInterface $postRepository)
    {
        $this->postRepository = $postRepository;
    }


    public function store($request)
    {
        return $this->postRepository->store($request);
    }

    public function fetchAll()
    {
        return $this->postRepository->fetchAll();
    }

    public function get($id)
    {
        return $this->postRepository->get($id);
    }

    public function search($name)
    {
        return $this->postRepository->search($name);
    }

    public function update($id, $request)
    {
        return $this->postRepository->update($id, $request);
    }

    public function delete($id)
    {
        return $this->postRepository->delete($id);
    }
}
