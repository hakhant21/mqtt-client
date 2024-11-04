<?php

namespace Hakhant\Broker\Contracts;

interface ClientInterface
{
    public function connect();

    public function publish(string $topic, string $message, int $qos = 0, bool $retain = false);

    public function subscribe(string $topic, callable $callback = null, int $qos = 0);

    public function disconnect();

    public function loop();
}