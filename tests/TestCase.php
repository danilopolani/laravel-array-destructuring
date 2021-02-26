<?php

namespace Danilopolani\ArrayDestructuring\Tests;

use Danilopolani\ArrayDestructuring\ArrayDestructuringServiceProvider;
use Orchestra\Testbench\TestCase as BaseTestCase;

class TestCase extends BaseTestCase
{
    use \Mockery\Adapter\Phpunit\MockeryPHPUnitIntegration;

    /** {@inheritDoc} */
    protected function getPackageProviders($app)
    {
        return [ArrayDestructuringServiceProvider::class];
    }
}
