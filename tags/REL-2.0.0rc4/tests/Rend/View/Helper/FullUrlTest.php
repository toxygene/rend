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

/** Rend_View_Helper_FullUrl */
require_once "Rend/View/Helper/FullUrl.php";

/** Zend_Controller_Front */
require_once "Zend/Controller/Front.php";

/** Zend_Controller_Request_HttpTestCase */
require_once "Zend/Controller/Request/HttpTestCase.php";

/** Zend_View */
require_once "Zend/View.php";

/**
 * @category Rend
 * @subpackage UnitTest
 */
class Rend_View_Helper_FullUrlTest extends PHPUnit_Framework_TestCase
{

    private $_helper;

    public function setUp()
    {
        $this->_helper = new Rend_View_Helper_FullUrl();

        $this->_helper
             ->setView(new Zend_View());

        Zend_Controller_Front::getInstance()
                             ->getRouter()
                             ->addDefaultRoutes();
    }

    public function testRequestIsLazyLoadedFromTheFrontController()
    {
        $request = new Rend_Controller_Request_Http_FullUrlMock();

        $request->setServer("HTTP_HOST", "http://test.example.org");

        Zend_Controller_Front::getInstance()
                             ->setRequest($request);

        $this->assertEquals(
            "http://test.example.org/",
            $this->_helper->direct()
        );
    }

    public function testRequestIsOverloadable()
    {
        $request = new Rend_Controller_Request_Http_FullUrlMock();

        $request->setServer("HTTP_HOST", "http://test.example.org");

        $this->_helper
             ->setRequest($request);

        $this->assertEquals(
            "http://test.example.org/",
            $this->_helper->direct()
        );
    }

}

class Rend_Controller_Request_Http_FullUrlMock extends Zend_Controller_Request_Http
{

    private $_server = array();

    public function setServer($key, $value)
    {
        $this->_server[$key] = $value;
        return $this;
    }

    public function getServer($key = null, $default = null)
    {
        if (isset($this->_server[$key])) {
            return $this->_server[$key];
        }

        return parent::getServer($key, $default);
    }

}