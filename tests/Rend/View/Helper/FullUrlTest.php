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

/** Rend_Controller_Request_Http */
require_once 'Rend/Controller/Request/Http.php';

/** Rend_View_Helper_FullUrl */
require_once 'Rend/View/Helper/FullUrl.php';

/** Zend_View */
require_once 'Zend/View.php';

/**
 *
 */
class Rend_View_Helper_FullUrlTest extends PHPUnit_Framework_TestCase
{

    private $_helper;

    private $_request;

    public function setup()
    {
        $front = Rend_Controller_Front::getInstance();
        $front->resetInstance();
        $front->getRouter()->addDefaultRoutes();

        $this->_helper  = new Rend_View_Helper_FullUrl();
        $this->_request = new Rend_Controller_Request_Http();

        $this->_helper->setView(new Zend_View());

        $front->setRequest($this->_request);
    }

    public function tearDown()
    {
        Rend_Controller_Front::getInstance()
                             ->resetInstance();

        unset($this->_helper);
        unset($this->_request);
    }

    public function testCompleteUrlsAreReturned()
    {
        $this->_request->setParam('SERVER_NAME', 'localhost')
                       ->setParam('SERVER_PORT', 80);

        $this->assertEquals(
            'http://localhost/fdsa/index/test/g/h',
            $this->_helper->fullUrl(array('module' => 'fdsa', 'action' => 'test', 'g' => 'h'))
        );
    }

    public function testSslUrlsAreSupported()
    {
        $this->_request->setParam('SERVER_NAME', 'localhost')
                       ->setParam('SERVER_PORT', 443)
                       ->setParam('HTTPS', 'on');

        $this->assertEquals(
            'https://localhost/fdsa/index/test/g/h',
            $this->_helper->fullUrl(array('module' => 'fdsa', 'action' => 'test', 'g' => 'h'))
        );
    }

    public function testAlternativePortsAreSupported()
    {
        $this->_request->setParam('SERVER_NAME', 'localhost')
                       ->setParam('SERVER_PORT', 8080);

        $this->assertEquals(
            'http://localhost:8080/fdsa/index/test/g/h',
            $this->_helper->fullUrl(array('module' => 'fdsa', 'action' => 'test', 'g' => 'h'))
        );
    }

}
