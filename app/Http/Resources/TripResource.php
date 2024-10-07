<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class TripResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'destination' => [
                'id' => $this->destination->id,
                'name' => $this->destination->name
            ],
            'price' => $this->price,
            'available_seats' => $this->available_seats,
            'start_date' => $this->start_date,
            'end_date' => $this->end_date,
            'status' => $this->statusTrip
        ];
    }
}
