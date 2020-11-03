<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tasks extends Model
{
    protected $fillable = [
        'name',
        'user',
        'date',
        'description'
    ];

    public function taskcomments()
    {
        return $this->hasMany(TaskComments::class);
    }
}
