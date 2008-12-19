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
    define("PHPUnit_MAIN_METHOD", "Rend_AllTests::main");
}

require_once dirname(__FILE__) . "/TestHelper.php";
require_once "Rend/RandomTest.php";
require_once "Rend/Factory/AllTests.php";
require_once "Rend/Filter/AllTests.php";
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
        $suite->addTest(Rend_Factory_AllTests::suite());
        $suite->addTestSuite("Rend_FactoryLoaderTest");
        $suite->addTestSuite(Rend_Filter_AllTests::suite());
        $suite->addTestSuite("Rend_RandomTest");
        $suite->addTest(Rend_View_Helper_AllTests::suite());

        return $suite;
    }
}

if (PHPUnit_MAIN_METHOD == "Rend_AllTests::main") {
    Rend_AllTests::main();
}
