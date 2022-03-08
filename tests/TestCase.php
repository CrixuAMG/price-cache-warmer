<?php

namespace CrixuAMG\PriceCacheWarmer\Test;

use CrixuAMG\PriceCacheWarmer\Drivers\AbstractDriver;
use CrixuAMG\PriceCacheWarmer\Drivers\DriverManager;
use CrixuAMG\PriceCacheWarmer\PriceCacheWarmer;

/**
 * Class TestCase
 *
 * @package CrixuAMG\PriceCacheWarmer\Test
 */
abstract class TestCase extends \PHPUnit\Framework\TestCase
{
    /**
     *
     */
    public function setUp(): void
    {
        DriverManager::macro('createTestDriver', function () {
            return new class extends AbstractDriver {
                public function cache(PriceCacheWarmer $priceCacheWarmer, callable $callback): void
                {
                    // TODO: Implement cache() method.
                }

                public function fetchFromCache()
                {
                    // TODO: Implement fetchFromCache() method.
                }

                public function getMigrationName(): string
                {
                    // TODO: Implement getMigrationName() method.
                }

                public function insertIntoCache(): bool
                {
                    // TODO: Implement insertIntoCache() method.
                }
            };
        });

        parent::setUp();
    }
}
