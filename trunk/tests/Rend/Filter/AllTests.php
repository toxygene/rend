<?php
/**
 *
 */

if (!defined("PHPUnit_MAIN_METHOD")) {
    define("PHPUnit_MAIN_METHOD", "Rend_Filter_AllTests::main");
}

require_once dirname(dirname(__FILE__)) . "/TestHelper.php";
require_once 'Rend/Filter/BooleanTest.php';
require_once 'Rend/Filter/NullTest.php';
require_once 'Rend/Filter/WordsToUpperTest.php';

/**
 *
 */
class Rend_Filter_AllTests
{

    public static function main()
    {
        PHPUnit_TextUI_TestRunner::run(self::suite());
    }

    public static function suite()
    {
        $suite = new PHPUnit_Framework_TestSuite("Rend Filter Tests");

        $suite->addTestSuite("Rend_Filter_BooleanTest");
        $suite->addTestSuite("Rend_Filter_NullTest");
        $suite->addTestSuite("Rend_Filter_WordsToUpperTest");

        return $suite;
    }
}

if (PHPUnit_MAIN_METHOD == "Rend_AllTests::main") {
    Rend_Filter_AllTests::main();
}
