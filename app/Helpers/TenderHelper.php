<?php

 namespace App\Helpers;

 use Illuminate\Support\Facades\DB;
 use App\Tender;
 use App\Manager;
 use App\Customer;

 class TenderHelper {
     public $tender;

     public function __construct($tender) {
         $this->tender = $tender;
     }

     public function manager() {
         $manager = Manager::find($this->tender->manager_id);

         if (isset($manager)) {
             return $manager->full_name();
         } else {
             return 'Не назначен';
         }
     }

     public function customer() {
         $customer = Customer::find($this->tender->customer_id);

         if (isset($customer)) {
             return $customer->name_short;
         } else {
             return 'Не назначен';
         }
     }

     public function courier() {
         return 'Не назначен';
     }

     public function purchase() {
        $merch_number = 0;
        $merch_number_delivered = 0;
        $merch_array = $this->tender->merchandises;

        foreach ($merch_array as $merch) {
             $merch_number += $merch->number;

             if ($merch->delivery_status != null) {
                $merch_number_delivered += $merch->number;
            }
        }

        if (($merch_number_delivered && $merch_number) != 0) {
            $percent = ($merch_number_delivered / $merch_number)* 100;

            return round($percent);
        } else {
            return 0;
        }
     }

     public function status_style() {
         $percent = $this->purchase();

         if ($percent >= 0 && $percent <= 50) {
             return "color: #721c24;";
         } elseif ($percent > 50 && $percent <= 99) {
             return "color: #856404;";
         } elseif ($percent == 100) {
             return "color: #155724;";
         }
     }
 }
