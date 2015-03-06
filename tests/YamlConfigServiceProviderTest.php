<?php

use Silex\Application;

class YamlConfigServiceProviderTest extends \PHPUnit_Framework_TestCase
{

    public function testConfigServiceProvider()
    {
        $app = new Application();

        $app->register(new \Mooseware\Silex\YamlConfigServiceProvider([
            'configPath' => __DIR__ . '/fixtures',
        ]));

        $this->assertTrue(isset($app['config']));
        $this->assertArrayHasKey("YamlTest", $app['config']);
        $this->assertArrayHasKey("Item1", $app['config']['YamlTest']);
        $this->assertEquals("Test1", $app['config']['YamlTest']['Item1']);
        $this->assertArrayHasKey("Item2", $app['config']['YamlTest']);
        $this->assertTrue(is_array($app['config']['YamlTest']['Item2']));
        $this->assertArrayHasKey("Item2Sub1", $app['config']['YamlTest']['Item2']);
        $this->assertArrayHasKey("Item2Sub2", $app['config']['YamlTest']['Item2']);
        $this->assertEquals("Item2Sub1Test1", $app['config']['YamlTest']['Item2']['Item2Sub1']);
        $this->assertEquals("Item2Sub1Test2", $app['config']['YamlTest']['Item2']['Item2Sub2']);
        $this->assertArrayHasKey("Item3", $app['config']['YamlTest']);
        $this->assertEquals("Test3", $app['config']['YamlTest']['Item3']);
    }

}