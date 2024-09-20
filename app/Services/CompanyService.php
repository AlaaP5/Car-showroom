<?php

namespace App\Services;

use App\DTOs\CompanyDTO;
use App\Interfaces\CompanyRepositoryInterface;

class CompanyService
{
    protected $companyRepository;

    public function __construct(CompanyRepositoryInterface $companyRepository)
    {
        $this->companyRepository = $companyRepository;
    }


    public function store($request)
    {
        $imagePath = null;
        if ($request->image) {
            $image = $request->file('image')->getClientOriginalName();
            $imagePath = $request->file('image')->storeAs('companies', $image, 'files');
        }
        
        $companyDTO = CompanyDTO::fromArray([
            'name' => $request->name,
            'image' => asset('files/' . $imagePath),
        ]);
        return $this->companyRepository->store($companyDTO);
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
