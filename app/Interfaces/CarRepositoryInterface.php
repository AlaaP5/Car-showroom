<?php

namespace App\Interfaces;

use App\DTOs\CarDTO;

interface CarRepositoryInterface
{
    public function store(CarDTO $request);
    public function fetchAll();
    public function get($id);
    public function search($name);
    public function update($id, array $request);
    public function delete($id);
}
