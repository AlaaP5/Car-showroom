<?php

namespace App\Interfaces;

interface CommentRepositoryInterface
{
    public function store(array $request);
    public function get($id);
    public function update($id, array $request);
    public function delete($id);
    public function CommentsOfPost($id);
}
