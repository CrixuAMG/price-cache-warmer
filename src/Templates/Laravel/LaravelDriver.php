<?php

namespace CrixuAMG\PriceCacheWarmer\Templates\Laravel;

use CrixuAMG\PriceCacheWarmer\Templates\AbstractTemplateDriver;

class LaravelDriver extends AbstractTemplateDriver
{
    protected $driverPath = 'Laravel';

    public function fetchFromCache()
    {
        // TODO: Implement fetchFromCache() method.
    }

    public function getMigrationName(): string
    {
        $date = date('Y_m_d_His');
        return "{$date}_create_price_cache_table.php";
    }
}
