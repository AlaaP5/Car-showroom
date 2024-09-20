<?php

namespace App\Interfaces;


interface FavoriteRepositoryInterface
{
    public function store(array $request);
    public function favoriteOfCars();
    public function delete($id);
}
