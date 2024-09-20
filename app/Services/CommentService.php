<?php

namespace App\Services;

use App\Interfaces\CommentRepositoryInterface;

class CommentService
{
    protected $commentRepository;

    public function __construct(CommentRepositoryInterface $commentRepository) {
        $this->commentRepository = $commentRepository;
    }


    public function store($request)
    {
        return $this->commentRepository->store($request);
    }

    public function get($id)
    {
        return $this->commentRepository->get($id);
    }

    public function update($id, $request)
    {
        return $this->commentRepository->update($id, $request);
    }

    public function delete($id)
    {
        return $this->commentRepository->delete($id);
    }

    public function CommentsOfPost($id)
    {
        return $this->commentRepository->CommentsOfPost($id);
    }
}
