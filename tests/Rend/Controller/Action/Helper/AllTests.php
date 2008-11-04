<?php
/**
 *
 */

/**
 * Test helper
 */
require_once dirname(dirname(dirname(dirname(__FILE__)))) . "/TestHelper.php";

if (!defined("PHPUnit_MAIN_METHOD")) {
    define("PHPUnit_MAIN_METHOD", "Rend_Controller_Action_Helper_AllTests::main");
}

require_once "Rend/Controller/Action/Helper/IsAllowedTest.php";
require_once "Rend/Controller/Action/Helper/LayoutSelectorTest.php";
require_once "Rend/Controller/Action/Helper/LoadModelTest.php";

/**
 *
 */
class Rend_Controller_Action_Helper_AllTests
{

    public static function main()
    {
        PHPUnit_TextUI_TestRunner::run(self::suite());
    }

    public static function suite()
    {
        $suite = new PHPUnit_Framework_TestSuite("Rend Controller Action Helper Tests");

        $suite->addTestSuite("Rend_Controller_Action_Helper_IsAllowed");
        $suite->addTestSuite("Rend_Controller_Action_Helper_LayoutSelector");
        $suite->addTestSuite("Rend_Controller_Action_Helper_LoadModel");

        return $suite;
    }
}

if (PHPUnit_MAIN_METHOD == "Rend_Controller_Action_Helper_AllTests::main") {
    Rend_Controller_Action_Helper_AllTests::main();
}
