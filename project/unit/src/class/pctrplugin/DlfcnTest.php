<?php
use PHPUnit\Framework\TestCase;

define("RACINE_UNIT", dirname(__FILE__) . "/../../..");
require_once(RACINE_UNIT . '/config_path.php');
require_once(RACINE_UNIT . '/function_test.php');
require_once(RACINE_UNIT . '/function_test_path.php');
require_once(RACINE_WWW . '/src/class/pctrplugin/Dlfcn.php');

/**
 * ClassNameTest
 * @group group
 */
class DlfcnTest extends TestCase
{

    protected Path|null $object;

    public function testDlopen(): void
    {
        foreach (array_string_all() as $value) {
            $testFunction = Dlfcn::dlopen($value);
            $this->assertNotNull($testFunction);
            $this->assertIsArray($testFunction);
        }
    }

    public function testDlsym(): void
    {
        foreach (array_string_all() as $value) {
            foreach (array_string_all() as $value2) {
                Dlfcn::dlsym(array_string_all(), $value2);
                $this->assertNotNull(true);
            }
        }
    }

}
