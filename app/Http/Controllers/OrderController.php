<?php

namespace App\Http\Controllers;

use App\Http\Requests\HistoryValidate;
use App\Http\Requests\OrderValidate;
use App\Services\OrderService;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    protected $order;
    public function __construct(OrderService $order) {
        $this->order = $order;
    }

    public function store(OrderValidate $request)
    {
        return $this->order->store($request);
    }

    public function orderContent($id)
    {
        return $this->order->orderContent($id);
    }

    public function history(HistoryValidate $request)
    {
        return $this->order->history($request);
    }

    public function myOrders()
    {
        return $this->order->myOrders();
    }

    public function AllOrders()
    {
        return $this->order->allOrders();
    }

    public function ProcessOrder($id)
    {
        return $this->order->editStatus($id);
    }

    public function CalculateProfit(HistoryValidate $request)
    {
        return $this->order->profit($request);
    }
}
