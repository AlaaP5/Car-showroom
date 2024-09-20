<?php

namespace App\Services;

use App\Interfaces\OrderRepositoryInterface;

class OrderService
{
    protected $orderRepository;

    public function __construct(OrderRepositoryInterface $orderRepository)
    {
        $this->orderRepository = $orderRepository;
    }


    public function store($request)
    {
        return $this->orderRepository->store($request);
    }

    public function orderContent($id)
    {
        return $this->orderRepository->orderContent($id);
    }

    public function history($request)
    {
        return $this->orderRepository->history($request);
    }

    public function myOrders()
    {
        return $this->orderRepository->myOrders();
    }

    public function allOrders()
    {
        return $this->orderRepository->allOrders();
    }

    public function editStatus($id)
    {
        return $this->orderRepository->editStatus($id);
    }

    public function profit($request)
    {
        return $this->orderRepository->profit($request);
    }
}
