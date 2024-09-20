<?php

namespace App\Repositories;


interface EvaluationRepositoryInterface
{
    public function store(array $request);
    public function get($id);
    public function evaluationsOfCar($id);
    public function delete($id);
}
