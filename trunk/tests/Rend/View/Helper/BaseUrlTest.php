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
 * @copyright 2008-2009 Justin Hendrickson
 * @license http://www.rendframework.com/license.html    New BSD License
 * @link http://www.rendframework.com/
 * @since 2.0.0
 * @version $Id$
 */

/** Rend_View_Helper_BaseUrl */
require_once "Rend/View/Helper/BaseUrl.php";

/**
 * @category Rend
 * @subpackage UnitTest
 */
class Rend_View_Helper_BaseUrlTest extends PHPUnit_Framework_TestCase
{

    private $_front;

    private $_helper;

    private $_request;

    public function setUp()
    {
        $this->_front   = Zend_Controller_Front::getInstance();
        $this->_helper  = new Rend_View_Helper_BaseUrl();
        $this->_request = new Zend_Controller_Request_HttpTestCase();

        $this->_front->setRequest($this->_request);
    }

    public function tearDown()
    {
        $this->_front
             ->resetInstance();
    }

    public function testBaseUrlIsFetchedFromRequest()
    {
        $this->_request
             ->setBaseUrl('/test/base/url');

        $this->assertEquals(
            '/test/base/url',
            $this->_helper->baseUrl()
        );

        $this->assertEquals(
            '/test/base/url',
            $this->_helper->direct()
        );
    }

}
