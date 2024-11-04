<?php

namespace Hakhant\Broker\Tests;

use Hakhant\Broker\Providers\ClientServiceProvider;
use Orchestra\Testbench\TestCase as OrchestraTestCase;

abstract class TestCase extends OrchestraTestCase
{
    protected function getPackageProviders($app)
    {
        return [
            ClientServiceProvider::class
        ];
    }
}
