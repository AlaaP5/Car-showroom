<?php

namespace App\DTOs;

class CompanyDTO
{
    public function __construct(
        public string $name,
        public string $image
    ) {}

    public function toArray(): array
    {
        return [
            'name' => $this->name,
            'image' => $this->image,
        ];
    }

    public static function fromArray(array $data): self
    {
        return new self(
            $data['name'],
            $data['image']
        );
    }
}
