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
 * @since 2.0.0
 * @version $Id$
 */

if (!defined("PHPUnit_MAIN_METHOD")) {
    define("PHPUnit_MAIN_METHOD", "Rend_Factory_AllTests::main");
}

require_once dirname(dirname(__FILE__)) . "/TestHelper.php";
require_once "Rend/Factory/AclTest.php";
require_once "Rend/Factory/AuthTest.php";
require_once "Rend/Factory/AuthAdapter/AllTests.php";
require_once "Rend/Factory/AuthStorage/AllTests.php";
require_once "Rend/Factory/Database/AllTests.php";
require_once "Rend/Factory/LogTest.php";
require_once "Rend/Factory/MailTest.php";
require_once "Rend/Factory/MailTransport/AllTests.php";
require_once "Rend/Factory/ViewTest.php";

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
        $suite->addTestSuite("Rend_Factory_AuthTest");
        $suite->addTest(Rend_Factory_AuthAdapter_AllTests::suite());
        $suite->addTest(Rend_Factory_AuthStorage_AllTests::suite());
        $suite->addTest(Rend_Factory_Database_AllTests::suite());
        $suite->addTestSuite("Rend_Factory_LogTest");
        $suite->addTestSuite("Rend_Factory_MailTest");
        $suite->addTest(Rend_Factory_MailTransport_AllTests::suite());
        $suite->addTestSuite("Rend_Factory_ViewTest");

        return $suite;
    }
}

if (PHPUnit_MAIN_METHOD == "Rend_Factory_AllTests::main") {
    Rend_Factory_AllTests::main();
}
