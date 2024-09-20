<?php

namespace App\Interfaces;

use App\DTOs\CategoryDTO;

interface CategoryRepositoryInterface
{
    public function store(CategoryDTO $request);
    public function fetchAll();
    public function get($id);
    public function update($id, array $request);
    public function search($name);
    public function deleteCategory($id);
    public function CarsOfCategory($id);
}
