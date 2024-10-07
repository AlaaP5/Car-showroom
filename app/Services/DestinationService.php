<?php

namespace App\Services;

use App\DTOs\DestinationDTO;
use App\Interfaces\DestinationRepositoryInterface;
use Illuminate\Http\JsonResponse;

class DestinationService
{
    protected DestinationRepositoryInterface $destinationRepository;

    public function __construct(DestinationRepositoryInterface $destinationRepository)
    {
        $this->destinationRepository = $destinationRepository;
    }

    public function indexOfDestination(): JsonResponse
    {
        return $this->destinationRepository->indexOfDestination();
    }

    public function createDestination(DestinationDTO $destinationDTO): JsonResponse
    {
        return $this->destinationRepository->createDestination($destinationDTO->toArray());
    }

    public function showDestination(int $id): JsonResponse
    {
        return $this->destinationRepository->showDestination($id);
    }

    public function updateDestination(DestinationDTO $destinationDTO): JsonResponse
    {
        return $this->destinationRepository->updateDestination($destinationDTO->toArray());
    }

    public function destroyDestination(int $id): JsonResponse
    {
        return $this->destinationRepository->destroyDestination($id);
    }

    public function tripsOfDestination(int $id): JsonResponse
    {
        return $this->destinationRepository->tripsOfDestination($id);
    }
}
