<?php

namespace App\DTOs;

class BookingDTO
{
    public function __construct(
        public int $trip_id,
        public int $seats_booked
    ) {}

    public function toArray(): array
    {
        return [
            'trip_id' => $this->trip_id,
            'seats_booked' => $this->seats_booked
        ];
    }

    public static function fromArray(array $data): self
    {
        return new self(
            $data['trip_id'],
            $data['seats_booked']
        );
    }
}
