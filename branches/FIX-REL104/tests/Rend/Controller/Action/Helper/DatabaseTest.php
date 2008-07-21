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

/** TestHelper */
require_once dirname(dirname(dirname(dirname(dirname(__FILE__))))) . '/TestHelper.php';

/**
 *
 */
class Rend_Controller_Action_Helper_DatabaseTest extends PHPUnit_Framework_TestCase
{

    public function tearDown()
    {
        Rend_Controller_Front::getInstance()->resetInstance();
        Zend_Controller_Action_HelperBroker::resetHelpers();
    }

    public function testConstructorCanSetTheConfigObject()
    {
        $config = new Zend_Config(array());

        $helper = new Rend_Controller_Action_Helper_Database($config);

        $this->assertSame(
            $config,
            $helper->getConfig()
        );
    }

    public function testConfigIsLazyLoaded()
    {
        $config = new Zend_Config(array());

        $helper = new Rend_Controller_Action_Helper_Database($config);

        $this->assertSame(
            $config,
            $helper->getConfig()
        );
    }

    public function testDatabaseIsLazyLoaded()
    {
        $this->markTestIncomplete('Implement mock handling for this test');
    }

    public function testDatabaseCanBeOverwritten()
    {
        $this->markTestIncomplete('Implement mock handling for this test');
    }

    public function testAnExceptionIsThrownWhenNoConfigInfoIsFound()
    {
        $this->setExpectedException('Zend_Controller_Action_Exception');

        $helper = new Rend_Controller_Action_Helper_Database(new Zend_Config(array()));

        $helper->getDatabase();
    }

}
