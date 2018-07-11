<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tender extends Model
{
    protected $fillable = [
        'number',
        'manager_id',
        'courier_id',
        'win'
    ];

}
