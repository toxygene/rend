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
class Rend_Controller_Action_Helper_SslSelectorTest extends PHPUnit_Framework_TestCase
{

    private $_controller;

    private $_redirector;

    public function setUp()
    {
        $this->_controller = new MockSslSelectorHelperController(
            new Rend_Controller_Request_Http(),
            new Zend_Controller_Response_Cli()
        );

        $this->_redirector = Zend_Controller_Action_HelperBroker::getStaticHelper('redirector')
                                                                ->setActionController($this->_controller)
                                                                ->setExit(false);
    }

    public function tearDown()
    {
        Rend_Controller_Front::getInstance()->resetInstance();
        Zend_Controller_Action_HelperBroker::resetHelpers();

        unset($this->_controller);
        unset($this->_redirector);
    }

    public function testConstructorCanSetHttpAndHttpsPorts()
    {
        $helper = $this->_getHelper(1, 2);

        $this->assertEquals(1, $helper->getHttpPort());
        $this->assertEquals(2, $helper->getHttpsPort());
    }

    public function testNoRedirectIsMadeWhenOnHttpAndAccessingNonSslAction()
    {
        $helper = $this->_getHelper();

        $helper->getRequest()->setParam('action', 'off')
                                    ->setParam('HTTPS', 'off');

        $helper->preDispatch();

        $this->assertFalse($helper->getResponse()->isRedirect());
    }

    public function testRedirectIsMadeToHttpsWhenOnHttpAndAccessingSslAction()
    {
        $helper = $this->_getHelper();
        $helper->getRequest()->setParam('action', 'on')
                             ->setParam('HTTPS', 'off');

        $helper->preDispatch();

        $this->assertTrue($helper->getResponse()->isRedirect());
        $this->assertEquals(301, $this->_redirector->getCode());
        $this->assertEquals('https://', $this->_redirector->getRedirectUrl());
    }

    public function testNoRedirectIsMadeWhenOnHttpsAndAccessingSslAction()
    {
        $helper = $this->_getHelper();
        $helper->getRequest()->setParam('action', 'on')
                             ->setParam('HTTPS', 'on');

        $helper->preDispatch();

        $this->assertFalse($helper->getResponse()->isRedirect());
    }

    public function testRedirectIsMadeToHttpWhenOnHttpsAndAccessingNonSslAction()
    {
        $helper = $this->_getHelper();
        $helper->getRequest()->setParam('action', 'off')
                             ->setParam('HTTPS', 'on');

        $helper->preDispatch();

        $this->assertTrue($helper->getResponse()->isRedirect());
        $this->assertEquals(301, $this->_redirector->getCode());
        $this->assertEquals('http://', $this->_redirector->getRedirectUrl());
    }

    public function testNonStandardHttpsPortsAreSupported()
    {
        $helper = $this->_getHelper(null, 998);
        $helper->getRequest()->setParam('action', 'on')
                             ->setParam('HTTPS', 'off');

        $helper->preDispatch();

        $this->assertTrue($helper->getResponse()->isRedirect());
        $this->assertEquals(301, $this->_redirector->getCode());
        $this->assertEquals('https://:998', $this->_redirector->getRedirectUrl());
    }

    public function testNonStandardHttpPortsAreSupported()
    {
        $helper = $this->_getHelper(999);
        $helper->getRequest()->setParam('action', 'off')
                             ->setParam('HTTPS', 'on');

        $helper->preDispatch();

        $this->assertTrue($helper->getResponse()->isRedirect());
        $this->assertEquals(301, $this->_redirector->getCode());
        $this->assertEquals('http://:999', $this->_redirector->getRedirectUrl());
    }

    private function _getHelper($httpPort = null, $httpsPort = null)
    {
        $helper = new Rend_Controller_Action_Helper_SslSelector(
            $httpPort,
            $httpsPort
        );

        $helper->setActionController($this->_controller);

        return $helper;
    }

}

class MockSslSelectorHelperController extends Zend_Controller_Action
{
    public $ssl = array(
        'on'  => true,
        'off' => false
    );
}
