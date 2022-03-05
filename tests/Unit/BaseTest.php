<?php

namespace CrixuAMG\PriceCacheWarmer\Test\Unit;

use CrixuAMG\PriceCacheWarmer\PriceCacheWarmer;
use CrixuAMG\PriceCacheWarmer\Templates\AbstractTemplateDriver;
use CrixuAMG\PriceCacheWarmer\Test\TestCase;

class BaseTest extends TestCase
{


    /** @test */
    public function a_driver_can_be_selected()
    {
        $driver = PriceCacheWarmer::create()->withDriver('test')->driver;

        $this->assertInstanceOf(AbstractTemplateDriver::class, $driver);
    }
}
