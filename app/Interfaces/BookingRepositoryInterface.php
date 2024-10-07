<?php

namespace App\Interfaces;

interface BookingRepositoryInterface
{
    public function createBooking(array $request);
    public function destroyBooking(int $id);
}
