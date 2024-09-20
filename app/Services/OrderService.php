<?php

namespace App\Services;

use App\Models\Car;
use App\Models\Order;
use App\Models\Sale;
use App\Models\User;
use App\Models\Wallet;
use App\Repositories\OrderRepositoryInterface;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

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
