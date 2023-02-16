<?php

namespace App\Helpers\Vendors;

use App\Vendors\Marvel;
use Illuminate\Support\Facades\Log;

class MarvelHelper{

    /**
     * Get config
     */
    public static function Config(){
        Marvel::$base_uat_url = config('vendors.marvel.dev_url');
        Marvel::$base_prod_url = config('vendors.marvel.prod_url');
        Marvel::$isProduction = config('vendors.marvel.is_production');
        Marvel::$publicKey = config('vendors.marvel.public_key');
        Marvel::$serverKey = config('vendors.marvel.private_key').config('vendors.marvel.public_key');
        if (Marvel::$isProduction) {
            Marvel::$serverKey = config('vendors.marvel.private_key').config('vendors.marvel.public_key');
        }
    }
}

