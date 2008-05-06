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

/** Rend_View_Helper_BaseUrl */
require_once 'Rend/View/Helper/BaseUrl.php';

/**
 *
 */
class Rend_View_Helper_BaseUrlTest extends PHPUnit_Framework_TestCase
{

    private $_helper;

    private $_request;

    public function setup()
    {
        Rend_Controller_Front::getInstance()
                             ->resetInstance();

        $this->_helper  = new Rend_View_Helper_BaseUrl();
        $this->_request = new Zend_Controller_Request_Http();

        Rend_Controller_Front::getInstance()
                             ->setRequest($this->_request);
    }

    public function tearDown()
    {
        Rend_Controller_Front::getInstance()
                             ->resetInstance();

        unset($this->_helper);
        unset($this->_request);
    }

    public function testTheBaseUrlCanBeRetrieved()
    {
        $this->_request->setBaseUrl('this-is-a-test');

        $this->assertEquals('this-is-a-test', $this->_helper->baseUrl());
    }

}
