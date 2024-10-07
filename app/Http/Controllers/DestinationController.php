<?php

namespace App\Http\Controllers;

use App\DTOs\DestinationDTO;
use App\Http\Requests\DestinationValidate;
use App\Http\Requests\UpdateDestinationValidate;
use App\Services\DestinationService;
use Illuminate\Http\JsonResponse;

class DestinationController extends Controller
{
    protected DestinationService $destinationService;

    public function __construct(DestinationService $destinationService)
    {
        $this->destinationService = $destinationService;
    }

    public function indexOfDestination(): JsonResponse
    {
        return $this->destinationService->indexOfDestination();
    }

    public function createDestination(DestinationValidate $request): JsonResponse
    {
        $destinationDTO = DestinationDTO::fromArray($request->validated());
        return $this->destinationService->createDestination($destinationDTO);
    }

    public function showDestination(int $id): JsonResponse
    {
        return $this->destinationService->showDestination($id);
    }

    public function updateDestination(UpdateDestinationValidate $request): JsonResponse
    {
        $destinationDTO = DestinationDTO::fromArray($request->validated());
        return $this->destinationService->updateDestination($destinationDTO);
    }

    public function destroyDestination(int $id): JsonResponse
    {
        return $this->destinationService->destroyDestination($id);
    }

    public function tripsOfDestination(int $id): JsonResponse
    {
        return $this->destinationService->tripsOfDestination($id);
    }
}
