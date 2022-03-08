<?php

namespace CrixuAMG\PriceCacheWarmer\Templates\Magento2;

use CrixuAMG\PriceCacheWarmer\Templates\AbstractTemplateDriver;

class Magento2Driver extends AbstractTemplateDriver
{
    public function fetchFromCache()
    {
        // TODO: Implement fetchFromCache() method.
    }

    public function getMigrationName(): string
    {
        return 'db_schema.xml';
    }
}
