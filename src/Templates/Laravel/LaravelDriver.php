<?php

namespace CrixuAMG\PriceCacheWarmer\Templates\Laravel;

use CrixuAMG\PriceCacheWarmer\PriceCacheWarmer;
use CrixuAMG\PriceCacheWarmer\Templates\AbstractTemplateDriver;

class LaravelDriver extends AbstractTemplateDriver
{
    public function cache(PriceCacheWarmer $priceCacheWarmer, callable $callback): void
    {
        // Collect data and cache
    }
}