<?php
/**
 * Rend
 *
 * LICENSE
 *
 * This source file is subject to the new BSD license that is bundled
 * with this package in the file LICENSE.txt.
 * It is also available through the world-wide-web at this URL:
 * http://rend.superglobals.com/License
 * If you did not receive a copy of the license and are unable to
 * obtain it through the world-wide-web, please send an email
 * to justin.hendrickson+rend@gmail.com so I can send you a copy immediately.
 *
 * @category   Rend
 * @package    Tests
 * @copyright  Copyright (c) 2005-2007 Zend Technologies USA Inc. (http://rend.superglobals.com)
 * @license    http://rend.superglobals.com/License New BSD License
 * @version    $Id$
 */

if(!defined('PHPUnit_MAIN_METHOD')) {
    define('PHPUnit_MAIN_METHOD', 'Rend_AllTests::main');
}

/** Rend_Controller_Action_Helper_AclTest */
require_once 'Rend/Controller/Action/Helper/AclTest.php';

/** Rend_Controller_Action_Helper_AuthTest */
require_once 'Rend/Controller/Action/Helper/AuthTest.php';

/** Rend_Controller_Action_Helper_ConfigTest */
require_once 'Rend/Controller/Action/Helper/ConfigTest.php';

/** Rend_Controller_Action_Helper_DatabaseTest */
require_once 'Rend/Controller/Action/Helper/DatabaseTest.php';

/** Rend_Controller_Action_Helper_IsAllowedTest */
require_once 'Rend/Controller/Action/Helper/IsAllowedTest.php';

/** Rend_Controller_Action_Helper_LayoutSelectorTest */
require_once 'Rend/Controller/Action/Helper/LayoutSelectorTest.php';

/** Rend_Controller_Action_Helper_LocaleTest */
require_once 'Rend/Controller/Action/Helper/LocaleTest.php';

/** Rend_Controller_Action_Helper_MailTest */
require_once 'Rend/Controller/Action/Helper/MailTest.php';

/** Rend_Controller_Action_Helper_ModelTest */
require_once 'Rend/Controller/Action/Helper/ModelTest.php';

/** Rend_Controller_Action_Helper_SslSelectorTest */
require_once 'Rend/Controller/Action/Helper/SslSelectorTest.php';

/** Rend_Controller_Action_Helper_TranslatorTest */
require_once 'Rend/Controller/Action/Helper/TranslatorTest.php';

/** Rend_Controller_Action_Helper_ViewTest */
require_once 'Rend/Controller/Action/Helper/ViewTest.php';

/** Rend_Controller_FrontTest */
require_once 'Rend/Controller/FrontTest.php';

/** Rend_Controller_Request_HttpTest */
require_once 'Rend/Controller/Request/HttpTest.php';

/** Rend_Filter_BooleanTest */
require_once 'Rend/Filter/BooleanTest.php';

/** Rend_Filter_NullTest */
require_once 'Rend/Filter/NullTest.php';

/** Rend_PaginationTest */
require_once 'Rend/PaginationTest.php';

/** Rend_UtilitiesTest */
require_once 'Rend/UtilitiesTest.php';

/** Rend_Validate_StringEqualsTest */
require_once 'Rend/Validate/StringEqualsTest.php';

/** Rend_View_Helper_BaseUrlTest */
require_once 'Rend/View/Helper/BaseUrlTest.php';

/** Rend_View_Helper_CycleTest */
require_once 'Rend/View/Helper/CycleTest.php';

/** Rend_View_Helper_DefaultValueTest */
require_once 'Rend/View/Helper/DefaultValueTest.php';

/** Rend_View_Helper_FullUrlTest */
require_once 'Rend/View/Helper/FullUrlTest.php';

/** Rend_View_Helper_IsAllowedTest */
require_once 'Rend/View/Helper/IsAllowedTest.php';

/** Rend_View_Helper_TruncateTest */
require_once 'Rend/View/Helper/TruncateTest.php';

/**
 *
 */
class Rend_AllTests {

    /**
     *
     */
    public static function main() {
        PHPUnit_TextUI_TestRunner::run(self::suite());
    }

    public static function suite() {
        $suite = new PHPUnit_Framework_TestSuite('Rend');

        $suite->addTestSuite('Rend_Controller_Action_Helper_AclTest');
        $suite->addTestSuite('Rend_Controller_Action_Helper_AuthTest');
        $suite->addTestSuite('Rend_Controller_Action_Helper_ConfigTest');
        $suite->addTestSuite('Rend_Controller_Action_Helper_DatabaseTest');
        $suite->addTestSuite('Rend_Controller_Action_Helper_IsAllowedTest');
        $suite->addTestSuite('Rend_Controller_Action_Helper_LayoutSelectorTest');
        $suite->addTestSuite('Rend_Controller_Action_Helper_LocaleTest');
        $suite->addTestSuite('Rend_Controller_Action_Helper_MailTest');
        $suite->addTestSuite('Rend_Controller_Action_Helper_SslSelectorTest');
        $suite->addTestSuite('Rend_Controller_Action_Helper_TranslatorTest');
        $suite->addTestSuite('Rend_Controller_Action_Helper_ViewTest');
        $suite->addTestSuite('Rend_Controller_FrontTest');
        $suite->addTestSuite('Rend_Controller_Request_HttpTest');
        $suite->addTestSuite('Rend_Filter_BooleanTest');
        $suite->addTestSuite('Rend_Filter_NullTest');
        $suite->addTestSuite('Rend_PaginationTest');
        $suite->addTestSuite('Rend_UtilitiesTest');
        $suite->addTestSuite('Rend_Validate_StringEqualsTest');
        $suite->addTestSuite('Rend_View_Helper_BaseUrlTest');
        $suite->addTestSuite('Rend_View_Helper_CycleTest');
        $suite->addTestSuite('Rend_View_Helper_DefaultValueTest');
        $suite->addTestSuite('Rend_View_Helper_FullUrlTest');
        $suite->addTestSuite('Rend_View_Helper_IsAllowedTest');
        $suite->addTestSuite('Rend_View_Helper_TruncateTest');

        return $suite;
    }
}

if(PHPUnit_MAIN_METHOD == 'AllTests::main') {
    AllTests::main();
}
