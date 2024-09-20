<?php

namespace App\Repositories;


interface FavoriteRepositoryInterface
{
    public function store(array $request);
    public function favoriteOfCars();
    public function delete($id);
}
