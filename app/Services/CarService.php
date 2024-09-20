<?php

namespace App\Services;

use App\DTOs\CarDTO;
use App\Interfaces\CarRepositoryInterface;

class CarService
{
    protected $carRepository;

    public function __construct(CarRepositoryInterface $carRepository)
    {
        $this->carRepository = $carRepository;
    }


    public function store($request)
    {
        $imagePath = null;
        if ($request->image) {
            $image = $request->file('image')->getClientOriginalName();
            $imagePath = $request->file('image')->storeAs('cars', $image, 'files');
        }

        $carDTO = CarDTO::fromArray([
            'model' => $request->model,
            'image' => asset('files/' . $imagePath),
            'mileage' => $request->mileage,
            'color' => $request->color,
            'status' => $request->status,
            'gear' => $request->gear,
            'engine' => $request->engine,
            'speed' => $request->speed,
            'quantity' => $request->quantity,
            'year' => $request->year,
            'details' => $request->details,
            'fuel' => $request->fuel,
            'category_id' => $request->category_id,
            'company_id' => $request->company_id,
            'priceC' => $request->priceC,
            'priceI' => $request->priceI
        ]);
        return $this->carRepository->store($carDTO);
    }

    public function fetchAll()
    {
        return $this->carRepository->fetchAll();
    }

    public function get($id)
    {
        return $this->carRepository->get($id);
    }

    public function search($name)
    {
        return $this->carRepository->search($name);
    }

    public function update($id, $request)
    {
        return $this->carRepository->update($id, $request);
    }

    public function delete($id)
    {
        return $this->carRepository->delete($id);
    }
}
