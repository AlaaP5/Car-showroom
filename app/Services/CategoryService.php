<?php

namespace App\Services;

use App\Repositories\CategoryRepositoryInterface;

class CategoryService
{
    protected $categoryRepository;

    public function __construct(CategoryRepositoryInterface $categoryRepository) {
        $this->categoryRepository = $categoryRepository;
    }


    public function store($request)
    {
        return $this->categoryRepository->store($request);
    }

    public function fetchAll()
    {
        return $this->categoryRepository->fetchAll();
    }

    public function get($id)
    {
        return $this->categoryRepository->get($id);
    }

    public function update($id, $request)
    {
        return $this->categoryRepository->update($id, $request);
    }

    public function search($name)
    {
        return $this->categoryRepository->search($name);
    }

    public function deleteCategory($id)
    {
        return $this->categoryRepository->deleteCategory($id);
    }

    public function CarsOfCategory($id)
    {
        return $this->categoryRepository->CarsOfCategory($id);
    }
}
