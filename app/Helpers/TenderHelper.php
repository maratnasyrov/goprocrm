<?php

 namespace App\Helpers;

 use Illuminate\Support\Facades\DB;
 use App\Tender;
 use App\Manager;
 use App\Customer;

 class TenderHelper {
     public $tender_id;

     public function __construct($tender_id) {
         $this->tender_id = $tender_id;
     }

     public function manager() {
         $tender = Tender::find($this->tender_id);
         $manager = Manager::find($tender->manager_id);

         if (isset($manager)) {
             return $manager->full_name();
         } else {
             return 'Не назначен';
         }
     }

     public function customer()
     {
         $tender = Tender::find($this->tender_id);
         $customer = Customer::find($tender->customer_id);

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
