<?php

namespace App\DTOs;

class UserDTO
{
    public function __construct(
        public ? string $name = null,
        public ? string $email = null,
        public ? string $password = null
    ) {}

    public function toArray(): array
    {
        return [
            'name' => $this->name,
            'email' => $this->email,
            'password' => $this->password
        ];
    }

    public static function fromArray(array $data): self
    {
        return new self(
            $data['name'] ?? null,
            $data['email'] ?? null,
            $data['password'] ?? null
        );
    }
}
