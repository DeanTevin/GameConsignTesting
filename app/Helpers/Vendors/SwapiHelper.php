<?php

namespace App\Helpers\Vendors;

use App\Vendors\Swapi;
use Illuminate\Support\Facades\Log;

class SwapiHelper{

    /**
     * Get config
     */
    public static function Config(){
        Swapi::$base_uat_url = config('vendors.swapi.dev_url');
        Swapi::$base_prod_url = config('vendors.swapi.prod_url');
        Swapi::$isProduction = config('vendors.swapi.is_production');
        if (Swapi::$isProduction) {
            Swapi::$serverKey = config('vendors.swapi.private_key');
        }
    }
}

