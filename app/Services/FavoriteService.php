<?php

namespace App\Services;

use App\Interfaces\FavoriteRepositoryInterface;

class FavoriteService
{

    protected $favoriteRepository;

    public function __construct(FavoriteRepositoryInterface $favoriteRepository) {
        $this->favoriteRepository = $favoriteRepository;
    }


    public function store($request)
    {
        return $this->favoriteRepository->store($request);
    }

    public function favoriteOfCars()
    {
        return $this->favoriteRepository->favoriteOfCars();
    }

    public function delete($id)
    {
        return $this->favoriteRepository->delete($id);
    }

}
