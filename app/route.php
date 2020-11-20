<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class route extends Model
{
    protected $fillable = [
        'departure',
        'arrival',
        'trip_duration'
    ];

    public function trips()
    {
        return $this->hasMany(Trip::class);
    }
}
