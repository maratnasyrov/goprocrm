<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Helpers\TenderHelper;

class Tender extends Model
{

    protected $fillable = [
        'name',
        'number',
        'manager_id',
        'courier_id',
        'customer_id',
        'win',
        'address',
        'address_last_day',
        'start_time',
        'end_time',
        'contract_price',
        'ensuring_order',
        'ensuring_contract',
        'delivery_time'
    ];

    public function merchandises()
    {
        return $this->hasMany('App\Merchandise');
    }

    public function purchase_price($merchandises_array)
    {
        $sum = 0;

        foreach ($merchandises_array as $merchandise ) {
            $sum += $merchandise->price * $merchandise->number;
        }

        return $sum;
    }

    public function difference($merchandises_array)
    {
        if (count($merchandises_array) && $this->contract_price > 0) {
            $all_total_payment = $this->all_total_payment($merchandises_array);

            if ($all_total_payment <= 0) {
                return round(-(($all_total_payment + $this->contract_price) / $this->contract_price) * 100, 2);
            } elseif ($all_total_payment > 0) {
                return round((($this->contract_price - $all_total_payment) / $this->contract_price) * 100, 2);
            }
        } else {
            return 0;
        }
    }

    public function super_procent($merchandises_array)
    {
        $sum = $this->purchase_price($merchandises_array);

        if ($sum == 0) {
            return 0;
        } elseif ($sum >= 0 && $sum <= 100000) {
            return 1.18401626;
        } elseif ($sum > 100000 && $sum <= 150000) {
            return 1.138287726;
        } elseif ($sum > 150000 && $sum <= 200000) {
            return 1.124191742;
        } elseif ($sum > 200000 && $sum <= 250000) {
            return 1.095020419;
        } elseif ($sum > 250000 && $sum <= 300000) {
            return 1.10317355;
        } elseif ($sum > 300000 && $sum <= 350000) {
            return 1.070752792;
        } elseif ($sum > 350000 && $sum <= 400000) {
            return 1.110643943;
        } elseif ($sum > 400000 && $sum <= 450000) {
            return 1.078623166;
        } elseif ($sum > 450000 && $sum <= 500000) {
            return 1.05;
        }
    }

    public function all_total_payment($merchandises_array)
    {
        $sum = 0;

        foreach ($merchandises_array as $merchandise) {
            $sum += $merchandise->set_total_order_payment($this, $merchandises_array);
        }

        return $sum;
    }

    public function supple_status($merchandises_array) {
        $supple_status = $this->difference($merchandises_array);

        if ($supple_status < 0) {
            return ["Цена закупки выше МЦК", "alert alert-danger"];
        } elseif ($supple_status > 24.9) {
            return ["Низкая цена закупки, проверьте ТЗ", "alert alert-warning"];
        } else {
            return ["Все ок", "alert alert-success"];
        }
    }
}
