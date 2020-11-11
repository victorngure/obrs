<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Trip extends Model
{
    protected $fillable = [
        'departure_location',
        'arrival_location',
        'departure_date',
        'departure_time',
        'departure_datetime',
        'trip_duration',
        'arrival_timestamp',
        'total_seats',
        'class_fare',
        'status',
        'cancellation_reason',
        'available_seats',
        'bus_id'
    ];

    public function bus()
    {
        return $this->belongsTo(Bus::class);
    }

    public function bookings()
    {
        return $this->hasMany(Booking::class);
    }
}
