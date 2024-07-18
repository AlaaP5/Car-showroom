<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;
    protected $table = 'orders';
    protected $fillable = [
        'user_id',
        'status_id',
        'payment_id',
        'date'
    ];

    public function cars()
    {
        return $this->belongsToMany(Car::class, 'sales');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function status()
    {
        return $this->belongsTo(Status::class);
    }

    public function paymentS()
    {
        return $this->belongsTo(Payment::class);
    }


}
