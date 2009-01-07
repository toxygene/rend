<?php
/**
 * Rend
 *
 * This source file is subject to the new BSD license that is bundled
 * with this package in the file LICENSE.txt.
 * It is also available through the world-wide-web at this URL:
 * http://www.rendframework.com/license.html
 * If you did not receive a copy of the license and are unable to
 * obtain it through the world-wide-web, please send an email
 * to justin.hendrickson+rend@gmail.com so I can send you a copy immediately.
 *
 * @category Rend
 * @subpackage UnitTest
 * @copyright 2008 Justin Hendrickson
 * @license http://www.rendframework.com/license.html    New BSD License
 * @link http://www.rendframework.com/
 * @since 1.0.0
 * @version $Id$
 */

if (!defined("PHPUnit_MAIN_METHOD")) {
    define("PHPUnit_MAIN_METHOD", "Rend_View_Helper_AllTests::main");
}

require_once dirname(dirname(dirname(__FILE__))) . "/TestHelper.php";
require_once "Rend/View/Helper/BasePathTest.php";
require_once "Rend/View/Helper/BaseUrlTest.php";
require_once "Rend/View/Helper/CycleTest.php";
require_once "Rend/View/Helper/DefaultValueTest.php";
require_once "Rend/View/Helper/FullUrlTest.php";
require_once "Rend/View/Helper/IsAllowedTest.php";
require_once "Rend/View/Helper/TruncateTest.php";

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

        $suite->addTestSuite("Rend_View_Helper_BasePathTest");
        $suite->addTestSuite("Rend_View_Helper_BaseUrlTest");
        $suite->addTestSuite("Rend_View_Helper_CycleTest");
        $suite->addTestSuite("Rend_View_Helper_DefaultValueTest");
        $suite->addTestSuite("Rend_View_Helper_FullUrlTest");
        $suite->addTestSuite("Rend_View_Helper_IsAllowedTest");
        $suite->addTestSuite("Rend_View_Helper_TruncateTest");

        return $suite;
    }
}

if (PHPUnit_MAIN_METHOD == "Rend_View_Helper_AllTests::main") {
    Rend_View_Helper_AllTests::main();
}
