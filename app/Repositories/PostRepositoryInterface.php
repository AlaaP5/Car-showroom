<?php

namespace App\Repositories;


interface PostRepositoryInterface
{
    public function store(array $request);
    public function fetchAll();
    public function get($id);
    public function search($name);  
    public function update($id, array $request);
    public function delete($id);
}
