<?php

namespace App\Http\Controllers;

use App\Http\Requests\CompanyValidate;
use App\Services\CompanyService;
use Illuminate\Http\Request;

class CompanyController extends Controller
{
    protected $Company;
    public function __construct(CompanyService $company)
    {
        $this->Company = $company;
    }

    public function store(CompanyValidate $request)
    {
        return $this->Company->store($request);
    }

    public function fetchAll()
    {
        return $this->Company->fetchAll();
    }

    public function fetch($id)
    {
        return $this->Company->get($id);
    }

    public function search($name = '')
    {
        return $this->Company->search($name);
    }

    public function deleteCompany($id)
    {
        return $this->Company->deleteCompany($id);
    }

    public function CarsOfCompany($id)
    {
        return $this->Company->CarsOfCompany($id);
    }
}
