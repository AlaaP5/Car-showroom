<?php

namespace App\Repositories;


interface CategoryRepositoryInterface
{
    public function store(array $request);
    public function fetchAll();
    public function get($id);
    public function update($id, array $request);
    public function search($name);
    public function deleteCategory($id);
    public function CarsOfCategory($id);
}
