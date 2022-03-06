<?php

namespace CrixuAMG\PriceCacheWarmer\Test;

use CrixuAMG\PriceCacheWarmer\PriceCacheWarmer;
use CrixuAMG\PriceCacheWarmer\Templates\AbstractTemplateDriver;
use CrixuAMG\PriceCacheWarmer\Templates\TemplateDriverManager;
use Orchestra\Testbench\TestCase as Orchestra;

/**
 * Class TestCase
 *
 * @package CrixuAMG\PriceCacheWarmer\Test
 */
abstract class TestCase extends Orchestra
{
    /**
     *
     */
    public function setUp(): void
    {
        TemplateDriverManager::macro('createTestDriver', function () {
            return new class extends AbstractTemplateDriver {
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
            };
        });

        parent::setUp();
    }
}
