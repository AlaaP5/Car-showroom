<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    use HasFactory;
    protected $table = 'payment_statuses';
    protected $fillable = [
        'payment_status'
    ];

    public function orders()
    {
        return $this->hasMany(Order::class);
    }
}
