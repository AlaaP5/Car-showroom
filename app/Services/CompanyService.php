<?php

namespace App\Services;

use App\Models\Car;
use App\Models\Company;
use App\Repositories\CompanyRepositoryInterface;

class CompanyService
{
    protected $companyRepository;

    public function __construct(CompanyRepositoryInterface $companyRepository)
    {
        $this->companyRepository = $companyRepository;
    }


    public function store($request)
    {
        return $this->companyRepository->store($request);
    }

    public function fetchAll()
    {
        return $this->companyRepository->fetchAll();
    }

    public function get($id)
    {
        return $this->companyRepository->get($id);
    }

    public function update($id, $request)
    {
        return $this->companyRepository->update($id, $request);
    }

    public function search($name)
    {
        return $this->companyRepository->search($name);
    }

    public function deleteCompany($id)
    {
        return $this->companyRepository->deleteCompany($id);
    }

    public function CarsOfCompany($id)
    {
        return $this->companyRepository->carsOfCompany($id);
    }
}
