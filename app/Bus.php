<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Bus extends Model
{
    protected $fillable = [
        'bus_type',
        'registration_number'
    ];

    public function trips()
    {
        return $this->hasMany(Trip::class);
    }
}
