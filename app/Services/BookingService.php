<?php

namespace App\Services;

use App\DTOs\BookingDTO;
use App\Interfaces\BookingRepositoryInterface;
use Illuminate\Http\JsonResponse;

class BookingService
{
    protected $bookingRepository;
    public function __construct(BookingRepositoryInterface $bookingRepository)
    {
        $this->bookingRepository = $bookingRepository;
    }


    public function createBooking(BookingDTO $bookingDTO): JsonResponse
    {
        return $this->bookingRepository->createBooking($bookingDTO->toArray());
    }

    public function destroyBooking(int $id): JsonResponse
    {
        return $this->bookingRepository->destroyBooking($id);
    }
}
