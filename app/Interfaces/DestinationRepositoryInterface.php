<?php

namespace App\Interfaces;

interface DestinationRepositoryInterface
{
    public function indexOfDestination();
    public function createDestination(array $request);
    public function showDestination(int $id);
    public function updateDestination(array $request);
    public function destroyDestination(int $id);
    public function tripsOfDestination(int $id);
}
