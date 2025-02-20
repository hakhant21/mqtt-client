<?php

use Hakhant\Broker\Client;
use PhpMqtt\Client\MqttClient;
use PhpMqtt\Client\ConnectionSettings;
use Mockery\Adapter\Phpunit\MockeryTestCase;
use Hakhant\Broker\Contracts\ClientInterface;

beforeEach(function () {
    // Create a mock for the MqttClient
    $this->mqttClientMock = Mockery::mock(MqttClient::class);
    
    // Create an instance of the Client class with the mocked MqttClient
    $this->client = app(ClientInterface::class);
    
    // Use reflection to set the private mqtt property to our mock
    $reflection = new ReflectionClass($this->client);
    $mqttProperty = $reflection->getProperty('mqtt');
    $mqttProperty->setAccessible(true);
    $mqttProperty->setValue($this->client, $this->mqttClientMock);
});

afterEach(function () {
    // Clean up mockery after each test
    Mockery::close();
});

it('connects to the MQTT broker', function () {
    $this->mqttClientMock
        ->shouldReceive('connect')
        ->once();
    
    $this->client->connect();
});

it('publishes a message correctly', function () {
    $topic = 'test/topic';
    $message = 'Hello, MQTT!';
    
    $this->mqttClientMock
        ->shouldReceive('publish')
        ->once()
        ->with($topic, $message, 0, false);
    
    $this->client->publish($topic, $message);
});

it('subscribes to a topic correctly', function () {
    $topic = 'test/topic';
    
    $this->mqttClientMock
        ->shouldReceive('subscribe')
        ->once()
        ->with($topic, Mockery::any());
    
    $this->client->subscribe($topic);
});

it('disconnects from the MQTT broker', function () {
    $this->mqttClientMock
        ->shouldReceive('disconnect')
        ->once();
    
    $this->client->disconnect();
});

it('loops correctly', function () {
    $this->mqttClientMock
        ->shouldReceive('loop')
        ->once()
        ->with(true);
    
    $this->client->loop();
});
