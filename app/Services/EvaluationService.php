<?php

namespace App\Services;

use App\Events\DeleteEvaluationEvent;
use App\Events\EvaluationCarEvent;
use App\Models\Car;
use App\Models\Evaluation;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Event;

class EvaluationService
{
    public function store($request)
    {
        DB::beginTransaction();
        try {
            $id = Auth::id();
            $input = $request->all();
            $input['user_id'] = $id;
            $evaluation = Evaluation::where('car_id', $input['car_id'])->where('user_id', $input['user_id'])->first();
            if (empty($evaluation)) {
                Evaluation::create($input);
                Event::dispatch(new EvaluationCarEvent($request->car_id, $request->rating));
            } else {
                $except = $request->rating - $evaluation->rating;
                $car = Car::find($request->car_id);
                $car->sumE = $car->sumE + $except;
                $evaluation->rating = $request->rating;
                $evaluation->body = $request->body;
                $evaluation->save();
                $car->save();
            }
            DB::commit();
            return response()->json(['message' => 'The car was successfully evaluated'], 200);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['message' => $e->getMessage()], 422);
        }
    }


    public function EvaluationsOfCar($id){
        $car = Car::find($id);
        if (empty($car)) {
            return response()->json(['message' => 'This car is not found'], 404);
        }
        $evaluations = Evaluation::where('car_id', $id)->get();
        if (!count($evaluations)) {
            return response()->json(['message' => 'not found any evaluation'], 404);
        }
        return response()->json(['data' => $evaluations], 200);
    }


    public function delete($id)
    {
        $user_id = Auth::id();
        $evaluation = Evaluation::where('id', $id)->where('user_id', $user_id)->first();
        if (empty($evaluation)) {
            return response()->json(['message' => 'not found'], 404);
        }
        $evaluation->delete();
        Event::dispatch(new DeleteEvaluationEvent($evaluation->car_id, $evaluation->rating));
        return response()->json(['Evaluation deleted successfully'], 200);
    }
}
