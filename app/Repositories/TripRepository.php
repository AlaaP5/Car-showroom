<?php

namespace App\Repositories;

use App\Helpers\DateNow;
use App\Helpers\LogHelper;
use App\Http\Resources\TripResource;
use App\Interfaces\TripRepositoryInterface;
use App\Models\Trip;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;

class TripRepository implements TripRepositoryInterface
{

    public function indexOfTrip(array $input): JsonResponse
    {

        $cacheKey = 'trips_' . md5(json_encode($input));

        $trips = Cache::remember($cacheKey, now()->addMinutes(10), function () use ($input) {
            return Trip::with('destination:id,name')
                ->when($input['destination'], function ($query, $destination) {
                    $query->whereHas('destination', function ($q) use ($destination) {
                        $q->where('name', 'like', '%' . $destination . '%');
                    });
                })
                ->when($input['start_date'] && $input['end_date'], function ($query) use ($input) {
                    $query->whereBetween('start_date', [$input['start_date'], $input['end_date']]);
                })
                ->when($input['available_seats'], function ($query, $seats) {
                    $query->where('available_seats', '>=', $seats);
                })
                ->paginate(10);
        });

        if ($trips->isEmpty()) {
            return response()->json(['message' => 'not found any Trip'], 404);
        }

        return response()->json([
            'data' => TripResource::collection($trips->items()),
            'pagination' => [
                'current_page' => $trips->currentPage(),
                'total_pages' => $trips->lastPage(),
                'total_items' => $trips->total(),
                'per_page' => $trips->perPage(),
                'first_page_url' => $trips->url(1),
                'last_page_url' => $trips->url($trips->lastPage())
            ]
        ], 200);
    }


    public function createTrip(array $input): JsonResponse
    {
        try {

            $input['start_date'] = DateNow::presentTime($input['start_date']);
            $input['end_date'] = DateNow::presentTime($input['end_date']);
            $trip = Trip::create($input);

            Cache::flush();

            LogHelper::logInfo('create_trip', 'Trip creation successful',  [
                'trip_id' => $trip->id,
                'user_id' => Auth::id(),
                'input_data' => $input
            ]);

            return response()->json(['message' => 'The Trip is added Successfully'], 201);
        } catch (\Exception $e) {

            LogHelper::logError('create_trip', 'Trip creation failed due to exception', [
                'user_id' => Auth::id(),
                'error_message' => $e->getMessage(),
                'input_data' => $input
            ]);

            return response()->json(['message' => $e->getMessage()], 422);
        }
    }


    public function showTrip($id): JsonResponse
    {
        $trip = Trip::where('id', $id)
            ->with('destination:id,name')
            ->first();

        if (empty($trip)) {
            return response()->json(['message' => 'The trip is not found'], 404);
        }

        return response()->json(['data' => new TripResource($trip)], 200);
    }


    public function updateTrip(array $newData): JsonResponse
    {
        try {
            $trip = Trip::find($newData['trip_id']);

            if (empty($trip)) {
                LogHelper::logWarning('update_trip', 'Trip is not found', [
                    'trip_id' => $newData['trip_id'],
                    'user_id' => Auth::id()
                ]);

                return response()->json(['message' => 'The Trip is not found'], 404);
            }

            $trip->update([
                'destination_id' => ($newData['destination_id']) ? $newData['destination_id'] : $trip->destination_id,
                'price' => ($newData['price']) ? $newData['price'] : $trip->price,
                'available_seats' => ($newData['available_seats']) ? $newData['available_seats'] : $trip->available_seats,
                'start_date' => ($newData['start_date']) ? DateNow::presentTime($newData['start_date']) : $trip->start_date,
                'end_date' => ($newData['end_date']) ? DateNow::presentTime($newData['end_date']) : $trip->end_date,
            ]);

            Cache::flush();

            LogHelper::logInfo('update_trip', 'Trip update successful', [
                'trip_id' => $trip->id,
                'user_id' => Auth::id(),
                'updated_data' => $newData
            ]);

            return response()->json(['message' => 'Trip updated successfully'], 200);
        } catch (\Exception $e) {

            LogHelper::logError('update_trip', 'Trip update failed due to exception', [
                'user_id' => Auth::id(),
                'error_message' => $e->getMessage(),
                'updated_data' => $newData
            ]);

            return response()->json(['message' => $e->getMessage()], 422);
        }
    }


    public function destroyTrip($id): JsonResponse
    {
        $trip = Trip::find($id);

        if (empty($trip)) {
            return response()->json(['message' => 'This trip is not found'], 404);
        }

        $dateNow = DateNow::presentTime(now());
        if ($dateNow < $trip->start_date || $trip->statusTrip === 'completed') {

            $trip->bookings()->delete();
            $trip->delete();

            Cache::flush();

            return response()->json(['message' => 'Trip has been deleted successfully'], 200);
        } else {
            return response()->json(['message' => 'you can not delete this a trip'], 403);
        }
    }
}
