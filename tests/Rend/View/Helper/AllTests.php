<?php
/**
 *
 */

if (!defined("PHPUnit_MAIN_METHOD")) {
    define("PHPUnit_MAIN_METHOD", "Rend_View_Helper_AllTests::main");
}

require_once dirname(dirname(dirname(__FILE__))) . "/TestHelper.php";
require_once "Rend/View/Helper/CycleTest.php";

/**
 *
 */
class Rend_View_Helper_AllTests
{

    public static function main()
    {
        PHPUnit_TextUI_TestRunner::run(self::suite());
    }

    public static function suite()
    {
        $suite = new PHPUnit_Framework_TestSuite("Rend View Helper");

        $suite->addTestSuite("Rend_View_Helper_CycleTest");

        return $suite;
    }
}

if (PHPUnit_MAIN_METHOD == "Rend_View_Helper_AllTests::main") {
    Rend_View_Helper_AllTests::main();
}
