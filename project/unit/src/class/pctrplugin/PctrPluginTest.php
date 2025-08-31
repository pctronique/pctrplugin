<?php
use PHPUnit\Framework\TestCase;

define("RACINE_UNIT", dirname(__FILE__) . "/../../..");
require_once(RACINE_UNIT . '/config_path.php');
require_once(RACINE_UNIT . '/function_test.php');
require_once(RACINE_UNIT . '/function_test_path.php');
require_once(RACINE_WWW . '/src/class/pctrplugin/PctrPlugin.php');

/**
 * ClassNameTest
 * @group group
 */
class PctrPluginTest extends TestCase
{


    protected PctrPlugin|null $object;

    protected function setUp(): void
    {
        foreach (array_string_all() as $value) {
            $this->object = new PctrPlugin($value);
            $this->testing();
        }
    }

    private function testing()
    {
        $this->testLoadPlugins();
    }
    
    public function testLoadPlugins(): void
    {
        foreach (array_string_all() as $value) {
            $this->object->loadPlugins($value);
            $this->testGetPlugins();
        }
    }
    
    public function testGetPlugins(): void
    {
        $testFunction = $this->object->getPlugins();
        $this->assertNotNull($testFunction);
        $this->assertIsArray($testFunction);
    }

}
