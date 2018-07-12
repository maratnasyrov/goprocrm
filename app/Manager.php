<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Manager extends Model
{
    protected $fillable = [
        'name',
        'surname',
        'phone'
    ];

    public function tenders()
    {
        return $this->hasMany('App\Manager', 'App\Tender');
    }

    public function full_name()
    {
        return $this->name . " " . $this->surname;
    }
}
