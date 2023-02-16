<?php

use App\Helpers\Vendors\MarvelHelper;
use App\Vendors\Marvel;

class VendorHelper{

    /**
     * Load all vendors
     */

     public static function LoadConfig(){
        MarvelHelper::Config();
     }
}