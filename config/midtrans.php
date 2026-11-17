<?php

return [
    'server_key' => env('MIDTRANS_SERVER_KEY', 'SB-Mid-server-YOUR_SANDBOX_KEY'),
    'client_key' => env('MIDTRANS_CLIENT_KEY', 'SB-Mid-client-YOUR_SANDBOX_KEY'),
    'is_production' => env('MIDTRANS_IS_PRODUCTION', false),
    'is_sanitized' => true,
    'is_3ds' => true,
];
