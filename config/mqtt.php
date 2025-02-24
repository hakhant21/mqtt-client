<?php

return [
    'default' => [
        'host' => env('MQTT_HOST', '127.0.0.1'),
        'port' => env('MQTT_PORT', 1883),
        'username' => env('MQTT_USERNAME', 'detpos'),
        'password' => env('MQTT_PASSWORD', 'asdffdsa'),
        'client_id' => env('MQTT_CLIENT_ID', 'mqtt-'.uniqid()),
        'keep_alive' => env('MQTT_KEEP_ALIVE', 60),
    ],
    'mqtt-two' => [
        'host' => env('MQTT_TWO_HOST', '127.0.0.1'),  // Second MQTT Host (you can change the default in .env)
        'port' => env('MQTT_TWO_PORT', 1884),         // Second MQTT Port
        'username' => env('MQTT_TWO_USERNAME', 'detpos'),  // Second Username
        'password' => env('MQTT_TWO_PASSWORD', 'asdffdsa'),  // Second Password
        'client_id' => env('MQTT_TWO_CLIENT_ID', 'mqtt-two-'.uniqid()),  // Unique client ID for mqtt-two
        'keep_alive' => env('MQTT_TWO_KEEP_ALIVE', 60),  // Keep Alive Interval for second broker
    ],
]; 