<?php
/**
 *
 */

if (!defined("PHPUnit_MAIN_METHOD")) {
    define("PHPUnit_MAIN_METHOD", "Rend_Factory_AllTests::main");
}

require_once dirname(dirname(__FILE__)) . "/TestHelper.php";
require_once "Rend/Factory/AclTest.php";

/**
 *
 */
class Rend_Factory_AllTests
{

    public static function main()
    {
        PHPUnit_TextUI_TestRunner::run(self::suite());
    }

    public static function suite()
    {
        $suite = new PHPUnit_Framework_TestSuite("Rend Factory Tests");

        $suite->addTestSuite("Rend_Factory_AclTest");

        return $suite;
    }
}

if (PHPUnit_MAIN_METHOD == "Rend_Factory_AllTests::main") {
    Rend_Factory_AllTests::main();
}
