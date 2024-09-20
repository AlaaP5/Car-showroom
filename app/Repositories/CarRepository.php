<?php

namespace App\Repositories;

use App\Interfaces\CarRepositoryInterface;
use App\Models\Car;

class CarRepository implements CarRepositoryInterface
{

    public function store($request)
    {
        try {
            $input = $request->toArray();
            $input['sumE'] = 0;
            $input['numE'] = 0;
            Car::create($input);
            return response()->json(['message' => 'The car is added Successfully'], 201);
        } catch (\Exception $e) {
            return response()->json(['message' => $e->getMessage()], 422);
        }
    }


    public function fetchAll()
    {
        $cars = Car::get();
        foreach ($cars as $car) {
            if ($car->numE != 0) {
                $car['evaluation'] = $car->sumE / $car->numE;
            }
        }
        if (!count($cars)) {
            return response()->json(['message' => 'not found'], 404);
        }
        return response()->json(['data' => $cars], 200);
    }


    public function get($id)
    {
        $car = Car::where('id', $id)->first();
        if (empty($car)) {
            return response()->json(['message' => 'not found'], 404);
        }
        return response()->json(['data' => $car], 200);
    }


    public function search($name)
    {
        $search = Car::where('model', 'like', '%' . $name . '%')->orderBy("model")->get();
        if (!count($search)) {
            return response()->json(['message' => 'not found'], 404);
        }
        return response()->json(['data' => $search], 200);
    }


    public function update($id, $request)
    {
        $car = Car::find($id);
        if ($request->image) {
            $image = $request->file('image')->getClientOriginalName();
            $path = $request->file('image')->storeAs('cars', $image, 'files');
        }
        $car->update([
            'model' => ($request->model) ? $request->model : $car->model,
            'image' => ($request->image) ? asset('files/' . $path) : $car->image,
            'mileage' => ($request->mileage) ? $request->mileage : $car->mileage,
            'color' => ($request->color) ? $request->color : $car->color,
            'status' => ($request->status) ? $request->status : $car->status,
            'gear' => ($request->gear) ? $request->gear : $car->gear,
            'year' => ($request->year) ? $request->year : $car->year,
            'quantity' => ($request->quantity) ? $request->quantity : $car->quantity,
            'speed' => ($request->speed) ? $request->speed : $car->speed,
            'category_id' => ($request->category_id) ? $request->category_id : $car->category_id,
            'company_id' => ($request->company_id) ? $request->company_id : $car->company_id,
            'priceC' => ($request->priceC) ? $request->priceC : $car->priceC,
            'priceI' => ($request->priceI) ? $request->priceI : $car->priceI,
            'fuel' => ($request->fuel) ? $request->fuel : $car->fuel,
            'engine' => ($request->engine) ? $request->engine : $car->engine,
            'details' => ($request->details) ? $request->details : $car->details
        ]);
        return response()->json(['message' => 'Car updated successfully'], 200);
    }


    public function delete($id)
    {
        $car = Car::find($id);
        if (empty($car)) {
            return response()->json(['message' => 'not found'], 404);
        }
        $car->delete();
        return response()->json(['message' => 'Car deleted successfully'], 200);
    }
}
