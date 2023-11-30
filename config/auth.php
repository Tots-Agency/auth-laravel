<?php

return [
    'key' => env('APP_KEY', ''),
    'method' => 'jwt',
    'iss' => 'https://tots.agency',
    'aud' => 'https://tots.agency',
    'expire' => 'P150D',
    'max_attempt' => 5,
];