<?php

namespace App\Http\Controllers;

use App\DTOs\FilterTripDTO;
use App\DTOs\TripDTO;
use App\Http\Requests\FilterTripValidate;
use App\Http\Requests\TripValidate;
use App\Http\Requests\UpdateTripValidate;
use App\Services\TripService;
use Illuminate\Http\JsonResponse;

class TripController extends Controller
{
    protected TripService $tripService;
    public function __construct(TripService $tripService)
    {
        $this->tripService = $tripService;
    }


    public function indexOfTrip(FilterTripValidate $request)
    {

        $tripDTO = FilterTripDTO::fromArray($request->validated());

        return $this->tripService->indexOfTrip($tripDTO);
    }

    public function createTrip(TripValidate $request): JsonResponse
    {
        $tripDTO = TripDTO::fromArray($request->validated());

        return $this->tripService->createTrip($tripDTO);
    }

    public function showTrip(int $id): JsonResponse
    {
        return $this->tripService->showTrip($id);
    }

    public function updateTrip(UpdateTripValidate $request): JsonResponse
    {
        $tripDTO = TripDTO::fromArray($request->validated());
        return $this->tripService->updateTrip($tripDTO);
    }

    public function destroyTrip(int $id): JsonResponse
    {
        return $this->tripService->destroyTrip($id);
    }
}
