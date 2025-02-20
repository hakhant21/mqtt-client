<?php

namespace Hakhant\Broker;

use PhpMqtt\Client\MqttClient;
use PhpMqtt\Client\ConnectionSettings;
use Hakhant\Broker\Contracts\ClientInterface;
use Hakhant\Broker\Exceptions\ClientException;

class Client implements ClientInterface
{
    private MqttClient $mqtt;
    private ConnectionSettings $settings;
    public function __construct(array $configs)
    {
        $this->mqtt = new MqttClient($configs['host'], $configs['port'], $configs['client_id']);
        $this->settings = (new ConnectionSettings())
                        ->setUsername($configs['username'])
                        ->setPassword($configs['password']);

        $this->connect();
    }

    public function connect()
    {
        try {
            $this->mqtt->connect($this->settings, true);
        } catch(ClientException $e) {
            echo $e->getMessage();
        }
    }

    public function publish(string $topic, string $message, int $qos = 0, bool $retain = false)
    {
         try {
            $this->mqtt->publish($topic, $message, $qos, $retain);
        } catch (ClientException $e) {
            echo $e->getMessage();
        }
    }   

    public function subscribe(string $topic, callable $callback = null, int $qos = 0)
    {
        try {
            $this->mqtt->subscribe($topic, function($topic, $message) use($callback) {
                $callback($topic, $message);
            });
        } catch (ClientException $e) {
            echo $e->getMessage();
        }
    }

    public function disconnect()
    {
        $this->mqtt->disconnect();
    }

    public function loop()
    {
        $this->mqtt->loop(true);
    }
}