<?php

namespace App\Repositories;

use App\Interfaces\FavoriteRepositoryInterface;
use App\Models\Favorite;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class FavoriteRepository implements FavoriteRepositoryInterface
{
    public function store($request)
    {
        $input = $request->all();
        $input['user_id']= Auth::id();
        $car= Favorite::where('user_id',$input['user_id'])->where('car_id',$input['car_id'])->first();
        if(!empty($car)){
            return response()->json(['message' => 'The car was already added'],403);
        }
        Favorite::create($input);
        return response()->json(['message' => 'The Car is added to your favorite'], 201);
    }


    public function favoriteOfCars()
    {
        $user_id=Auth::id();
        $cars = User::where('id',$user_id)->with('cars')->get();
        if (!count($cars)) {
            return response()->json(['message' => 'not found'], 404);
        }
        return response()->json(['data' => $cars], 200);
    }


    public function delete($id)
    {
        $user_id = Auth::id();
        $car = Favorite::where('car_id', $id)->where('user_id', $user_id)->first();
        if (empty($car)) {
            return response()->json(['message' => 'not found'], 404);
        }
        $car->delete();
        return response()->json(['Car deleted successfully'], 200);
    }
}
