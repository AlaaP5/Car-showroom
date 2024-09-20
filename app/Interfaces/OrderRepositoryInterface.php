<?php

namespace App\Interfaces;


interface OrderRepositoryInterface
{
    public function store(array $request);
    public function orderContent($id);
    public function history(array $request);
    public function myOrders();
    public function allOrders();
    public function editStatus($id);
    public function profit(array $request);
}
