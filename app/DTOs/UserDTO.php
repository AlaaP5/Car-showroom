<?php

namespace App\DTOs;

class UserDTO
{
    public function __construct(
        public string $FirstName,
        public string $LastName,
        public string $email,
        public string $password,
        public string $phone_number
    ) {}

    public function toArray(): array
    {
        return [
            'FirstName' => $this->FirstName,
            'LastName' => $this->LastName,
            'email' => $this->email,
            'password' => $this->password,
            'phone_number' => $this->phone_number
        ];
    }

    public static function fromArray(array $data): self
    {
        return new self(
            $data['FirstName'],
            $data['LastName'],
            $data['email'],
            $data['password'],
            $data['phone_number']
        );
    }
}
