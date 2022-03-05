<?php

namespace CrixuAMG\PriceCacheWarmer\Templates\Magento2;

use CrixuAMG\PriceCacheWarmer\PriceCacheWarmer;
use CrixuAMG\PriceCacheWarmer\Templates\AbstractTemplateDriver;

class Magento2Driver extends AbstractTemplateDriver
{
    public function cache(PriceCacheWarmer $priceCacheWarmer, callable $callback): void
    {
        // Collect data and cache
    }

    public function fetchFromCache()
    {
        // TODO: Implement fetchFromCache() method.
    }
}
