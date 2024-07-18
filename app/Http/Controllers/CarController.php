<?php

namespace App\Http\Controllers;

use App\Http\Requests\CarValidate;
use App\Services\CarService;
use Illuminate\Http\Request;

class CarController extends Controller
{
    protected $car;
    public function __construct(CarService $car)
    {
        $this->car = $car;
    }

    public function store(CarValidate $request)
    {
        return $this->car->store($request);
    }

    public function fetchAll()
    {
        return $this->car->fetchAll();
    }

    public function fetch($id)
    {
        return $this->car->get($id);
    }

    public function search($name = '')
    {
        return $this->car->search($name);
    }

    public function updateCar($id,Request $request)
    {
        return $this->car->update($id, $request);
    }

    public function deleteCar($id)
    {
        return $this->car->delete($id);
    }
}
