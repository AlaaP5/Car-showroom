<?php

namespace App\DTOs;

class CarDTO
{
    public function __construct(
        public string $model,
        public string $image,
        public string $mileage,
        public string $color,
        public string $status,
        public string $gear,
        public int $engine,
        public int $speed,
        public int $quantity,
        public int $year,
        public string $details,
        public string $fuel,
        public int $category_id,
        public int $company_id,
        public int $priceC,
        public int $priceI
    ) {}

    public function toArray(): array
    {
        return [
            'model' => $this->model,
            'image' => $this->image,
            'mileage' => $this->mileage,
            'color' => $this->color,
            'status' => $this->status,
            'gear' => $this->gear,
            'engine' => $this->engine,
            'speed' => $this->speed,
            'quantity' => $this->quantity,
            'year' => $this->year,
            'details' => $this->details,
            'fuel' => $this->fuel,
            'category_id' => $this->category_id,
            'company_id' => $this->company_id,
            'priceC' => $this->priceC,
            'priceI' => $this->priceI
        ];
    }

    public static function fromArray(array $data): self
    {
        return new self(
            $data['model'],
            $data['image'],
            $data['mileage'],
            $data['color'],
            $data['status'],
            $data['gear'],
            $data['engine'],
            $data['speed'],
            $data['quantity'],
            $data['year'],
            $data['details'],
            $data['fuel'],
            $data['category_id'],
            $data['company_id'],
            $data['priceC'],
            $data['priceI']
        );
    }
}
