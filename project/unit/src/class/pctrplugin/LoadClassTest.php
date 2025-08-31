<?php
use PHPUnit\Framework\TestCase;

define("RACINE_UNIT", dirname(__FILE__) . "/../../..");
require_once(RACINE_UNIT . '/config_path.php');
require_once(RACINE_UNIT . '/function_test.php');
require_once(RACINE_UNIT . '/function_test_path.php');
require_once(RACINE_WWW . '/src/class/pctrplugin/LoadClass.php');

/**
 * ClassNameTest
 * @group group
 */
class LoadClassTest extends TestCase
{

    protected LoadClass|null $object;

    protected function setUp(): void
    {
        foreach (array_string_all() as $value) {
            $this->object = new LoadClass($value);
            $this->testing();
        }
    }

    private function testing()
    {
        $this->testGetObj();
        $this->testGetName();
        $this->testGetExtend();
        $this->testGetInterfaces();
    }
    
    public function testGetObj(): void
    {
        $this->assertNotNull($this->object);
    }
    
    public function testGetName(): void
    {
        $testFunction = $this->object->getName();
        $this->assertNotNull($testFunction);
        $this->assertIsString($testFunction);
    }
    
    public function testGetExtend(): void
    {
        $testFunction = $this->object->getExtend();
        $this->assertNotNull($testFunction);
        $this->assertIsString($testFunction);
    }
    
    public function testGetInterfaces(): void
    {
        $testFunction = $this->object->getInterfaces();
        $this->assertNotNull($testFunction);
        $this->assertIsArray($testFunction);
    }

}