<?php

namespace App\Services;

use App\Models\Car;
use App\Models\Category;

class CategoryService
{
    public function store($request)
    {
        $input = $request->all();
        $image = $request->file('image')->getClientOriginalName();
        $path = $request->file('image')->storeAs('categories', $image, 'files');
        $input['image'] = $path;
        Category::create($input);
        return response()->json(['message' => 'The Category is added Successfully'], 201);
    }


    public function fetchAll()
    {
        $category = Category::orderBy("name")->get();
        if (!count($category)) {
            return response()->json(['message' => 'not found'], 404);
        }
        foreach ($category as $cat) {
            $cat->image = asset('files/' . $cat->image);
        }
        return response()->json(['data' => $category], 200);
    }


    public function get($id)
    {
        $category = Category::where('id', $id)->first();
        if (empty($category)) {
            return response()->json(['message' => 'not found'], 404);
        }
        $category->image = asset('files/' . $category->image);
        return response()->json(['data' => $category], 200);
    }


    public function search($name= " ")
    {
        $search = Category::where('name', 'like', '%' . $name . '%')->orderBy("name")->get();
        if (!count($search)) {
            return response()->json(['message' => 'not found'], 404);
        }
        foreach ($search as $cat) {
            $cat->image = asset('files/' . $cat->image);
        }
        return response()->json(['data' => $search], 200);
    }


    public function deleteCategory($id)
    {
        $category = Category::find($id);
        if(empty($category)){
            return response()->json(['message' => 'not found'],404);
        }
        $car = Car::where('category_id', $id)->first();
        if (!empty($car)) {
            return response()->json(['message' => 'you can not delete this category'], 403);
        }
        $category->delete();
        return response()->json(['Category deleted successfully'], 200);
    }


    public function CarsOfCategory($id)
    {
        $cars = Car::where('category_id', $id)->get();
        if (!count($cars)) {
            return response()->json(['message' => 'not found'], 404);
        }
        foreach ($cars as $car) {
            $car->image = asset('files/' . $car->image);
        }
        return response()->json(['data' => $cars], 200);
    }

}
