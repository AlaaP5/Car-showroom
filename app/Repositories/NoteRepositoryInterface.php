<?php

namespace App\Repositories;


interface NoteRepositoryInterface
{
    public function store(array $request);
    public function fetchAll();
    public function get($id);
    public function update($id, array $request);
    public function delete($id);
}
