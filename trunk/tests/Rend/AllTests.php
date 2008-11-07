<?php
/**
 *
 */

if (!defined("PHPUnit_MAIN_METHOD")) {
    define("PHPUnit_MAIN_METHOD", "Rend_AllTests::main");
}

require_once dirname(__FILE__) . "/TestHelper.php";
require_once "Rend/RandomTest.php";
require_once "Rend/View/Helper/AllTests.php";

/**
 *
 */
class Rend_AllTests
{

    public static function main()
    {
        PHPUnit_TextUI_TestRunner::run(self::suite());
    }

    public static function suite()
    {
        $suite = new PHPUnit_Framework_TestSuite("Rend Tests");

        $suite->addTest(Rend_Controller_AllTests::suite());
        $suite->addTestSuite("Rend_FactoryLoaderTest");
        $suite->addTestSuite("Rend_RandomTest");
        $suite->addTest(Rend_View_Helper_AllTests::suite());

        return $suite;
    }
}

if (PHPUnit_MAIN_METHOD == "Rend_AllTests::main") {
    Rend_AllTests::main();
}
