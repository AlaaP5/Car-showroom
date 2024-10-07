<?php

namespace App\Repositories;

use App\Http\Resources\DestinationResource;
use App\Http\Resources\TripResource;
use App\Interfaces\DestinationRepositoryInterface;
use App\Models\Destination;
use Illuminate\Http\JsonResponse;

class DestinationRepository implements DestinationRepositoryInterface
{
    public function indexOfDestination(): JsonResponse
    {
        $destinations = Destination::paginate(10);

        return response()->json([
            'data' => DestinationResource::collection($destinations->items()),
            'pagination' => [
                'current_page' => $destinations->currentPage(),
                'total_pages' => $destinations->lastPage(),
                'total_items' => $destinations->total(),
                'per_page' => $destinations->perPage(),
                'first_page_url' => $destinations->url(1),
                'last_page_url' => $destinations->url($destinations->lastPage())
            ]
        ], 200);
    }


    public function createDestination(array $data): JsonResponse
    {
        try {
            $destination = Destination::create($data);
            return response()->json(['message' => 'Destination created successfully'], 201);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Failed to create destination', 'error' => $e->getMessage()], 422);
        }
    }


    public function showDestination(int $id): JsonResponse
    {
        $destination = Destination::find($id);

        if (empty($destination)) {
            return response()->json(['message' => 'Destination not found'], 404);
        }
        return response()->json(['data' => new DestinationResource($destination)], 200);
    }


    public function updateDestination(array $newData): JsonResponse
    {
        $destination = Destination::find($newData['destination_id']);

        $destination->update([
            'name' => ($newData['name']) ? $newData['name'] : $destination->name
        ]);

        return response()->json(['message' => 'Destination updated successfully'], 200);
    }


    public function destroyDestination(int $id): JsonResponse
    {
        $destination = Destination::find($id);

        if (empty($destination)) {
            return response()->json(['message' => 'Destination not found'], 404);
        }

        if ($destination->trips->isEmpty()) {
            $destination->delete();
            return response()->json(['message' => 'Destination deleted successfully'], 200);
        }

        return response()->json(['message' => 'This destination has trips'], 403);
    }


    public function tripsOfDestination(int $id): JsonResponse
    {
        $destination = Destination::with('trips')->find($id);

        if (empty($destination)) {
            return response()->json(['message' => 'Destination not found'], 404);
        }

        if ($destination->trips->isEmpty()) {
            return response()->json(['message' => 'No trips found for this destination'], 404);
        }
        return response()->json(['data' => TripResource::collection($destination->trips)], 200);
    }
}
