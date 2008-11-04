<?php
/**
 *
 */

/**
 * Test helper
 */
require_once dirname(dirname(__FILE__)) . '/TestHelper.php';

if (!defined('PHPUnit_MAIN_METHOD')) {
    define('PHPUnit_MAIN_METHOD', 'Rend_Controller_AllTests::main');
}

require_once 'Rend/Controller/ActionTest.php';

/**
 *
 */
class Rend_Controller_AllTests
{

    public static function main()
    {
        PHPUnit_TextUI_TestRunner::run(self::suite());
    }

    public static function suite()
    {
        $suite = new PHPUnit_Framework_TestSuite('Rend Controller Tests');

        $suite->addTestSuite('Rend_Controller_ActionTest');

        return $suite;
    }
}

if (PHPUnit_MAIN_METHOD == 'Rend_Controller_AllTests::main') {
    Rend_Controller_AllTests::main();
}
