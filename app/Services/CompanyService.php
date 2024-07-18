<?php

namespace App\Services;

use App\Models\Car;
use App\Models\Company;

class CompanyService
{
    public function store($request)
    {
        $input = $request->all();
        Company::create($input);
        return response()->json(['message' => 'The Company has been added Successfully'], 201);
    }


    public function fetchAll()
    {
        $company = Company::orderBy("name")->get();
        if (!count($company)) {
            return response()->json(['message' => 'not found'], 404);
        }
        return response()->json(['data' => $company], 200);
    }


    public function get($id)
    {
        $company = Company::where('id', $id)->first();
        if (empty($company)) {
            return response()->json(['message' => 'not found'], 404);
        }
        return response()->json(['data' => $company], 200);
    }


    public function search($name = " ")
    {
        $search = Company::where('name', 'like', '%' . $name . '%')->orderBy("name")->get();
        if (!count($search)) {
            return response()->json(['message' => 'not found'], 404);
        }
        return response()->json(['data' => $search], 200);
    }


    public function deleteCompany($id)
    {
        $company = Company::find($id);
        if (empty($company)) {
            return response()->json(['message' => 'not found'], 404);
        }
        $car = Car::where('company_id', $id)->first();
        if (!empty($car)) {
            return response()->json(['message' => 'you can not delete this company'], 403);
        }
        $company->delete();
        return response()->json(['Company deleted successfully'], 200);
    }


    public function CarsOfCompany($id)
    {
        $cars = Car::where('company_id', $id)->get();
        if (!count($cars)) {
            return response()->json(['message' => 'not found'], 404);
        }
        foreach ($cars as $car) {
            $car->image = asset('files/' . $car->image);
        }
        return response()->json(['data' => $cars], 200);
    }
}
