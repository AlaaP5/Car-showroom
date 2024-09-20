<?php

namespace App\Services;

use App\Repositories\CarRepositoryInterface;


class CarService
{
    protected $carRepository;

    public function __construct(CarRepositoryInterface $carRepository)
    {
        $this->carRepository = $carRepository;
    }

    
    public function store($request)
    {
        return $this->carRepository->store($request);
    }

    public function fetchAll()
    {
        return $this->carRepository->fetchAll();
    }

    public function get($id)
    {
        return $this->carRepository->get($id);
    }

    public function search($name)
    {
        return $this->carRepository->search($name);
    }

    public function update($id, $request)
    {
        return $this->carRepository->update($id, $request);
    }

    public function delete($id)
    {
        return $this->carRepository->delete($id);
    }
}
