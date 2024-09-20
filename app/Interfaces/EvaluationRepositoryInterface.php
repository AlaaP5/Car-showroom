<?php

namespace App\Interfaces;


interface EvaluationRepositoryInterface
{
    public function store(array $request);
    public function get($id);
    public function evaluationsOfCar($id);
    public function delete($id);
}
