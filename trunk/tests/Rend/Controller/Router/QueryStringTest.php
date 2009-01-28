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

/** Rend_Controller_Router_QueryString */
require_once "Rend/Controller/Router/QueryString.php";

/**
 * @category Rend
 * @subpackage UnitTest
 */
class Rend_Controller_Router_QueryStringTest extends PHPUnit_Framework_TestCase
{

    protected $_router;

    public function setUp()
    {
        $this->_router = new Rend_Controller_Router_QueryString();
    }

    public function testAssemblingAddsToParams()
    {
        $this->_router->setParams(array(
            "one" => "two",
            "three" => array(
                "four",
                "five"
            )
        ));

        $this->assertEquals(
            "?one=two&three%5B0%5D=four&three%5B1%5D=five&six=seven",
            $this->_router->assemble(array("six" => "seven"))
        );
    }

    public function testAssemblingWithResetIgnoresParams()
    {
        $this->_router->setParams(array(
            "one" => "two",
            "three" => array(
                "four",
                "five"
            )
        ));

        $this->assertEquals(
            "?six=seven",
            $this->_router->assemble(array("six" => "seven"), null, true)
        );
    }

    /**
     *
     */
    public function testRoutingIncludesParams()
    {
        $this->_router->setParams(array(
            "one" => "two",
            "three" => array(
                "four",
                "five"
            )
        ));

        $request = new Zend_Controller_Request_Http("http://localhost/?six=seven");

        $this->assertEquals(
            array(
                "one" => "two",
                "three" => array(
                    "four",
                    "five"
                ),
                "six" => "seven"
            ),
            $this->_router->route($request)
        );
    }

}
