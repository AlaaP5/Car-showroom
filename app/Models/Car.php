<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Car extends Model
{
    use HasFactory;
    protected $table = 'cars';
    protected $fillable = [
        'nameType',
        'image',
        'model',
        'color',
        'status',
        'gear',
        'quantity',
        'category_id',
        'company_id',
        'sumE',
        'numE',
        'priceC',
        'priceI'
    ];

    public function orders()
    {
        return $this->belongsToMany(Order::class, 'sales');
    }

    public function users()
    {
        return $this->belongsToMany(User::class, 'favorites');
    }

    public function evaluations()
    {
        return $this->hasMany(Evaluation::class);
    }

    public function company()
    {
        return $this->belongsTo(Company::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

/*
$order = Order::find(1);
$cars = $order->cars;


$car = Car::find(1);
$orders = $car->orders;
*/

}
