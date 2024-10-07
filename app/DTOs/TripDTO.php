<?php

namespace App\DTOs;

class TripDTO
{
    public function __construct(
        public int $trip_id,
        public ?int $destination_id = null,
        public ?float $price = null,
        public ?int $available_seats = null,
        public ?string $start_date = null,
        public ?string $end_date = null
    ) {}

    public function toArray(): array
    {
        return [
            'trip_id' => $this->trip_id,
            'destination_id' => $this->destination_id,
            'price' => $this->price,
            'available_seats' => $this->available_seats,
            'start_date' => $this->start_date,
            'end_date' => $this->end_date
        ];
    }

    public static function fromArray(array $data): self
    {
        return new self(
            $data['trip_id'],
            $data['destination_id'] ?? null,
            $data['price'] ?? null,
            $data['available_seats'] ?? null,
            $data['start_date'] ?? null,
            $data['end_date'] ?? null
        );
    }
}
