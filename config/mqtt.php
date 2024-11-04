<?php

return [
    'host' => env('MQTT_HOST', '127.0.0.1'),
    'port' => env('MQTT_PORT', 1883),
    'username' => env('MQTT_USERNAME', 'detpos'),
    'password' => env('MQTT_PASSWORD', 'asdffdsa'),
    'client_id' => env('MQTT_CLIENT_ID', 'mqtt-'.uniqid()),
    'keep_alive' => env('MQTT_KEEP_ALIVE', 60),
];