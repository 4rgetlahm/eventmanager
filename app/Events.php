<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Events extends Model
{
    protected $table = 'events';

    protected $fillable = [
        'id', 'title', 'description', 'slots', 'registered', 'date',
    ];

}
