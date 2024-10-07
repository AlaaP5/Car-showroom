<?php

namespace App\Models;

use App\Helpers\DateNow;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Trip extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'trips';
    protected $fillable = [
        'destination_id',
        'price',
        'available_seats',
        'start_date',
        'end_date',
        'statusTrip'
    ];



    public function bookings()
    {
        return $this->hasMany(Booking::class);
    }

    public function destination()
    {
        return $this->belongsTo(Destination::class);
    }
}
