<?php

namespace App\DTOs;

class DestinationDTO
{
    public function __construct(
        public ? string $name = null,
        public ? int $destination_id = null
    ) {}

    public function toArray(): array
    {
        return [
            'name' => $this->name,
            'destination_id' => $this->destination_id
        ];
    }

    public static function fromArray(array $data): self
    {
        return new self(
            $data['name'] ?? null,
            $data['destination_id'] ?? null
        );
    }
}
