<?php

return [
"public_key" => env("MARVEL_PUBLIC_KEY",""),
"private_key" => env("MARVEL_PRIVATE_KEY",""),
"prod_url" => env("MARVEL_API_PROD_URL",""),
"dev_url" =>env("MARVEL_API_DEV_URL",""),
"is_production" =>env("MARVEL_PRODUCTION","")
];