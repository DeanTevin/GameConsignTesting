<?php

return [
    "private_key" => env("SWAPI_KEY",""),
    "prod_url" => env("SWAPI_API_PROD_URL",""),
    "dev_url" =>env("SWAPI_API_DEV_URL",""),
    "is_production" =>env("SWAPI_PRODUCTION","")
];