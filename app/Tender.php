<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tender extends Model
{
    protected $fillable = [
        'number',
        'manager_id',
        'courier_id',
        'customer_id',
        'win'
    ];

    public function manager() {
        $manager = Manager::find($this->manager_id);

        if (isset($manager)) {
            return $manager->full_name();
        } else {
            return 'Не назначен';
        }
    }

    public function courier() {
        return 'Не назначен';
    }

    public function customer() {
        $customer = Customer::find($this->customer_id);

        if (isset($customer)) {
            return $customer->name_short;
        } else {
            return 'Не назначен';
        }
    }
}
