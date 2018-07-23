<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Merchandise extends Model
{
    protected $fillable = [
        'name',
        'price',
        'number',
        'order_link',
        'order_number',
        'order_provider',
        'order_status',
        'order_payment',
        'order_payment_type',
        'order_payment_status',
        'order_comment',
        'delivery_tracker',
        'delivery_company',
        'delivery_date',
        'delivery_status',
        'delivery_place',
        'delivery_payment',
        'delivery_comment',
        'tender_id',
        'manager_id',
        'storekeeper_id'
    ];

    public function tender()
    {
        return $this->belongsTo('App\Merchandise', 'App\Tender');
    }
}
