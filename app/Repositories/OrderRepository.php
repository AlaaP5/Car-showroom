<?php

namespace App\Repositories;

use App\Models\Car;
use App\Models\Order;
use App\Models\Sale;
use App\Models\User;
use App\Models\Wallet;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class OrderRepository implements OrderRepositoryInterface
{
    public function store($request)
    {
        DB::beginTransaction();
        try {
            $total = 0;
            $cars = [];
            $car = $request->car;
            foreach ($car as $c) {
                $cars[] = [
                    'car_id' => $c['car_id'],
                    'quantity' => $c['quantity']
                ];
                $price = Car::find($c['car_id'])->priceI;
                $total += ($c['quantity'] * $price);
            }
            $order = Order::create([
                'user_id' => auth()->id(),
                'status_id' => 1,
                'payment_id' => 1,
                'orderDate' => now()->format('Y-m-d'),
                'totalPrice' => $total
            ]);
            foreach ($cars as $car) {
                Sale::create([
                    'order_id' => $order->id,
                    'car_id' => $car['car_id'],
                    'quantity' => $car['quantity']
                ]);
            }
            DB::commit();
            return response()->json(['data' => 'The Order has been added Successfully'], 201);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['message' => $e->getMessage()], 422);
        }
    }


    public function orderContent($id)
    {
        $orderContent = Order::where('id', $id)
            ->where('user_id', Auth::id())
            ->with('cars')
            ->get();

        if (!count($orderContent)) {
            return response()->json(['message' => 'not found'], 404);
        }
        return response()->json(['data' => $orderContent], 200);
    }


    public function history($request)
    {
        $orders = Order::with('status')
            ->where('user_id', Auth::id())
            ->where('status_id', 3)
            ->where('payment_id', 1)
            ->get();

        if (!count($orders)) {
            return response()->json(['message' => 'not found'], 404);
        }
        $from = date($request->from);
        $to = date($request->to);

        $data = [];
        foreach ($orders as $order) {
            if ($order->created_at >= $from && $order->created_at <= $to)
                $data[] = $order;
        }

        if (!count($data)) {
            return response()->json(['message' => 'not found'], 404);
        }
        return response()->json(['data' => $data], 200);
    }


    public function myOrders()
    {
        $id = Auth::id();
        $orders = User::where('id', $id)
            ->with('orders')
            ->get();

        if (!count($orders)) {
            return response()->json(['message' => 'not found'], 404);
        }
        return response()->json(['data' => $orders], 200);
    }


    // For Admin
    public function allOrders()
    {
        $orders = Order::with(['status', 'payment', 'cars'])
            ->get();
        if (!count($orders)) {
            return response()->json(['message' => 'not found any order'], 404);
        }
        return response()->json(['data' => $orders], 200);
    }


    public function editStatus($id)
    {
        DB::beginTransaction();
        try {
            $order = Order::with('cars')->find($id);
            foreach ($order->cars as $item) {
                $car = Car::find(($item->id));
                $carPivot = Sale::where('order_id', $id)->where('car_id', $car->id)->first();
                if (($carPivot->quantity) <= ($car->quantity)) {
                    $car->quantity = ($car->quantity) - ($carPivot->quantity);
                    $car->save();
                } else {
                    DB::rollBack();
                    return response()->json(['message' => 'Not enough quantity for car '], 422);
                }
            }
            $wallet = Wallet::where('user_id', $order->user_id)->first();
            if ($order->totalPrice <= $wallet->quantity) {
                $wallet->quantity -= $order->totalPrice;
                $wallet->save();
            }
            $order->status_id = 2;
            $order->payment_id = 2;
            $order->save();
            DB::commit();
            return response()->json(['message' => 'Order edit status successfully']);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['message' => $e->getMessage()], 422);
        }
    }


    public function profit($request)
    {
        $orders = Order::whereBetween('orderDate', [$request->from, $request->to])
            ->where('status_id', 2)
            ->with(['cars' => function ($query) {
                $query->select('cars.id', 'cars.priceI', 'cars.priceC', 'sales.quantity');
            }])
            ->get();

        $Profit = 0;
        foreach ($orders as $order) {
            foreach ($order->cars as $car) {
                $profitCar = ($car->priceI - $car->priceC) * $car->quantity;
                $Profit += $profitCar;
            }
        }
        return response(['data' => $Profit], 200);
    }
}
