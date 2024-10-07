<?php

namespace App\DTOs;

class FilterTripDTO
{
    public function __construct(
        public ? string $destination =null,
        public ? string $start_date =null,
        public ? string $end_date =null,
        public ? int $available_seats =null
    ) {}

    public function toArray(): array
    {
        return [
            'destination' => $this->destination,
            'start_date' => $this->start_date,
            'end_date' => $this->end_date,
            'available_seats' => $this->available_seats
        ];
    }

    public static function fromArray(array $data): self
    {
        return new self(
            $data['destination'] ?? null, 
            $data['start_date'] ?? null,
            $data['end_date'] ?? null,
            $data['available_seats'] ?? null
        );
    }
}
