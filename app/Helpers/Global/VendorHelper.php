<?php

use App\Helpers\Vendors\MarvelHelper;
use App\Helpers\Vendors\SwapiHelper;
use App\Vendors\Marvel;

class VendorHelper{

    /**
     * Load all vendors
     */

     public static function LoadConfig(){
        MarvelHelper::Config();
        SwapiHelper::Config();
     }
}