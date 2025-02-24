# Hakhant Laravel MQTT Client

This is a simple Laravel wrapper for interacting with MQTT brokers using the `PhpMqtt\Client` library. It provides an easy way to publish and subscribe to topics, and handle MQTT connections.

## Requirements

- PHP 8.0 or higher
- Composer (for managing dependencies)
- PhpMqtt\Client library

## Installation

To get started, you need to install the MQTT Client package via Composer:

```bash
composer require hakhant/mqtt-client

```

## Create a configuration file for the MQTT client. Run the following artisan command to publish the configuration file:

```bash 
php artisan vendor:publish --provider="Hakhant\Broker\Providers\ClientServiceProvider" --tag="config"
```

## This will create a config/mqtt.php file in your Laravel project where you can define the necessary configuration options for connecting to the MQTT broker.

```php
// config/mqtt.php
return [
    'host'     => env('MQTT_HOST', 'broker.hivemq.com'), // The MQTT broker host
    'port'     => env('MQTT_PORT', 1883),                // MQTT Broker port (default 1883)
    'username' => env('MQTT_USERNAME', ''),               // Optional: MQTT Username (if required)
    'password' => env('MQTT_PASSWORD', ''),               // Optional: MQTT Password (if required)
    'client_id'=> env('MQTT_CLIENT_ID', 'your-client-id'),// A unique client ID for the connection
    'keep_alive' => env('MQTT_KEEP_ALIVE', 60) // Keepalive interval ( default 60 )
];

```
## Environment Configuration

```dotenv

MQTT_HOST=127.0.0.1
MQTT_PORT=1883
MQTT_USERNAME=username
MQTT_PASSWORD=password
MQTT_CLIENT_ID=my-client-id
MQTT_KEEP_ALIVE=60

```

## Usage 

```php
use Hakhant\Broker\Client;

class MqttController extends Controller
{
    protected $mqttClient;

    public function __construct(Client $mqttClient)
    {
        $this->mqttClient = $mqttClient;
    }

    public function publishMessage()
    {
        $topic = 'topic/test';
        $message = 'Hello from Laravel MQTT!';
        $qos = 0; // Quality of Service level
        $retain = false; // Whether the message should be retained

        // Publish message
        $this->mqttClient->publish($topic, $message, $qos, $retain);

        return response()->json(['status' => 'Message Published']);
    }

    public function subscribeToTopic()
    {
        $topic = 'topic/test';
        $this->mqttClient->subscribe($topic, function($topic, $message) {
            // Handle the received message
            echo "Message received on topic {$topic}: {$message}\n";
        });

        // Keep the loop running to listen for messages
        while (true) {
            $this->mqttClient->loop();
        }
    }
}

```

### Summary of Features:
- **MQTT Client Service**: Easily integrate with Laravel using a service provider.
- **Environment Configuration**: Define broker settings in `.env` and `config/mqtt.php`.
- **Publish/Subscribe**: Methods to publish messages and subscribe to topics in your controllers.
- **Looping for Messages**: Keep the MQTT connection alive by running the loop in the background.
  
This should allow you to easily integrate MQTT into a Laravel application! Let me know if you need any further modifications.