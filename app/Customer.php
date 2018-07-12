<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    protected $fillable = [
        'name_full',
        'name_short',
        'contact_name',
        'contact_phone',
        'email',
        'site',
        'time_zone',
        'inn',
        'kpp',
        'okpo',
        'ogrn'
    ];

    public function tenders()
    {
        return $this->hasMany('App\Customer', 'App\Tender');
    }
}
