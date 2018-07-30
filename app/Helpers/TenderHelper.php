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

     public function customer()
     {
         $customer = Customer::find($this->tender->customer_id);

         if (isset($customer)) {
             return $customer->name_short;
         } else {
             return 'Не назначен';
         }
     }

     public function courier()
     {
         return 'Не назначен';
     }
 }
