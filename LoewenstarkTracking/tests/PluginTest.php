<?php

namespace LoewenstarkTracking\Tests;

use LoewenstarkTracking\LoewenstarkTracking as Plugin;
use Shopware\Components\Test\Plugin\TestCase;

class PluginTest extends TestCase
{
    protected static $ensureLoadedPlugins = [
        'LoewenstarkTracking' => []
    ];

    public function testCanCreateInstance()
    {
        /** @var Plugin $plugin */
        $plugin = Shopware()->Container()->get('kernel')->getPlugins()['LoewenstarkTracking'];

        $this->assertInstanceOf(Plugin::class, $plugin);
    }
}
