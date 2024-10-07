<?php

namespace App\Http\Controllers;

use App\DTOs\BookingDTO;
use App\Http\Requests\BookingValidate;
use App\Services\BookingService;
use Illuminate\Http\JsonResponse;

class BookingController extends Controller
{
    protected BookingService $bookingService;
    public function __construct(BookingService $bookingService)
    {
        $this->bookingService = $bookingService;
    }


    public function createBooking(BookingValidate $request): JsonResponse
    {
        $bookingDTO = BookingDTO::fromArray($request->validated());
        return $this->bookingService->createBooking($bookingDTO);
    }

    public function destroyBooking(int $id): JsonResponse
    {
        return $this->bookingService->destroyBooking($id);
    }
}
