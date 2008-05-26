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

/** Rend_Controller_Front */
require_once 'Rend/Controller/Front.php';

/** Zend_Auth */
require_once 'Zend/Auth.php';

/** Zend_Auth_Storage_NonPersistent */
require_once 'Zend/Auth/Storage/NonPersistent.php';

/** Zend_Controller_Response_Cli */
require_once 'Zend/Controller/Response/Cli.php';

/**
 *
 */
class Rend_Controller_FrontTest extends PHPUnit_Framework_TestCase
{

    private $_front;

    public function setUp()
    {
        $this->_front = Rend_Controller_Front::getInstance();

        Zend_Controller_Action_HelperBroker::getStaticHelper('auth')->getAuth()->setStorage(new Zend_Auth_Storage_NonPersistent());

        $this->_front->setControllerDirectory('.')
                     ->setResponse(new Zend_Controller_Response_Cli())
                     ->setParam('noErrorHandler', true)
                     ->returnResponse(true)
                     ->throwExceptions(false);
    }

    public function tearDown()
    {
        Zend_Auth::getInstance()->clearIdentity();

        Rend_Controller_Front::getInstance()->resetInstance();
        Zend_Controller_Action_HelperBroker::resetHelpers();

        unset($this->_front);
    }

    public function testIsAllowedHelperCanBeEnabled()
    {
        $this->_front->enableIsAllowedHelper();
        $this->assertTrue(Zend_Controller_Action_HelperBroker::hasHelper('isAllowed'));
    }

    public function testLayoutSelectorHelperCanBeEnabled()
    {
        $this->_front->enableLayoutSelectorHelper();
        $this->assertTrue(Zend_Controller_Action_HelperBroker::hasHelper('layoutSelector'));
    }

    public function testSslSelectorHelperCanBeEnabled()
    {
        $this->_front->enableSslSelectorHelper();
        $this->assertTrue(Zend_Controller_Action_HelperBroker::hasHelper('sslSelector'));
    }

    public function testIsAllowedHelperUsesTheAuthIdentityRoleThird()
    {
        Zend_Auth::getInstance()->getStorage()->write((object) array('role' => 'one'));
        $this->_front->enableIsAllowedHelper();

        $this->assertEquals(
            'one',
            Zend_Controller_Action_HelperBroker::getStaticHelper('isAllowed')->getRole()
        );
    }

}
