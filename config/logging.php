// Cấu hình các kênh logging
'channels' => [

    'stack' => [
        'driver' => 'stack',
        'channels' => 'single',
        'ignore_exeptions' => false,
        ],

    'single' => [
        'driver' => 'single',
        'path' => storage_path('logs/laravel.log'),
    ],

    'customer' => [
        'driver' => 'single',
        'path' => storage_path('logs/customer.log'),
        'level' => levels
    ],
],



// Cấu hình các mức độ logging
'levels' => [
    'debug' => env('APP_DEBUG', false),
    'info' => true,
    'warning' => true,
    'error' => true,
],