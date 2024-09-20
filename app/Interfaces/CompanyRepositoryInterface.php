<?php

namespace App\Interfaces;

use App\DTOs\CompanyDTO;

interface CompanyRepositoryInterface
{
    public function store(CompanyDTO $request);
    public function fetchAll();
    public function get($id);
    public function update($id, array $request);
    public function search($name);
    public function deleteCompany($id);
    public function CarsOfCompany($id);
}
