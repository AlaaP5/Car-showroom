<?php

namespace App\Repositories;


interface CompanyRepositoryInterface
{
    public function store(array $request);
    public function fetchAll();
    public function get($id);
    public function update($id, array $request);
    public function search($name);
    public function deleteCompany($id);
    public function CarsOfCompany($id);
}
