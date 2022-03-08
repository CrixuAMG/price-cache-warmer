<?php

namespace CrixuAMG\PriceCacheWarmer\Laravel;

use CrixuAMG\PriceCacheWarmer\AbstractTemplateDriver;

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

    public function insertIntoCache(): bool
    {
        // TODO: Implement insertIntoCache() method.
    }
}
