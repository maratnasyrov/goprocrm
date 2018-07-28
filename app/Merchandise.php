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
        return $this->belongsTo('App\Tender');
    }

    public function set_order_payment($tender, $merchandises_array)
    {
        $super_procent = $tender->super_procent($merchandises_array);

        return round($this->price * $super_procent);
    }

    public function set_total_order_payment($tender, $merchandises_array)
    {
        return $this->set_order_payment($tender, $merchandises_array) * $this->number;
    }
}
