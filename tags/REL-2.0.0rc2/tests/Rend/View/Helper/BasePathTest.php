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

/** Rend_View_Helper_BasePath */
require_once "Rend/View/Helper/BasePath.php";

/**
 * @category Rend
 * @subpackage UnitTest
 */
class Rend_View_Helper_BasePathTest extends PHPUnit_Framework_TestCase
{

    private $_front;

    private $_helper;

    private $_request;

    public function setUp()
    {
        $this->_front   = Zend_Controller_Front::getInstance();
        $this->_helper  = new Rend_View_Helper_BasePath();
        $this->_request = new Zend_Controller_Request_HttpTestCase();

        $this->_front->setRequest($this->_request);
    }

    public function tearDown()
    {
        $this->_front
             ->resetInstance();
    }

    public function testBasePathIsFetchedFromRequest()
    {
        $this->_request
             ->setBasePath('/test/base/path');

        $this->assertEquals(
            '/test/base/path',
            $this->_helper->basePath()
        );

        $this->assertEquals(
            '/test/base/path',
            $this->_helper->direct()
        );
    }

}
