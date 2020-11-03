<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TaskComments extends Model
{
    protected $fillable = [
        'title',
        'date',
    ];

    public function tasks()
    {
        return $this->belongsTo(Tasks::class);
    }
}
