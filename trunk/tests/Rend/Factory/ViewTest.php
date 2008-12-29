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

/** Rend_Factory_View */
require_once "Rend/Factory/View.php";

/**
 * @category Rend
 * @subpackage UnitTest
 */
class Rend_Factory_ViewTest extends PHPUnit_Framework_TestCase
{

    private $_factory;

    protected function setUp()
    {
        $this->_factory = new Rend_Factory_View();
    }

    public function testCreateReturnsAViewObject()
    {
        $this->assertType(
            "Zend_View",
            $this->_factory
                 ->create()
        );
    }

    public function testDoctypeIsConfigurable()
    {
        $view = $this->_factory
                     ->setDoctype("XHTML1_STRICT")
                     ->create();

        $this->assertEquals(
            "XHTML1_STRICT",
            $view->getHelper("Doctype")
                 ->getDoctype()
        );
    }

    public function testEncodingIsConfigurable()
    {
        $view = $this->_factory
                     ->setEncoding("UTF-8")
                     ->create();

        $this->assertEquals(
            "UTF-8",
            $view->getEncoding()
        );
    }

    public function testEscapeIsConfigurable()
    {
        $view = $this->_factory
                     ->setEscape("htmlentities")
                     ->create();

        $this->assertEquals(
            "htmlentities",
            $this->readAttribute($view, "_escape")
        );
    }

    public function testFilterPathsAreConfigurable()
    {
        $view = $this->_factory
                     ->setFilterPaths(array("One", array("prefix" => "Two", "path" => "Two")))
                     ->create();

        $this->assertEquals(
            array(
                "Zend_View_Filter_" => array(
                    "Zend/View/Filter/",
                    "One/"
                ),
                "Two_" => array(
                    "Two/"
                )
            ),
            $view->getFilterPaths()
        );
    }


    public function testHelperPathsAreConfigurable()
    {
        $view = $this->_factory
                     ->setHelperPaths(array("One", array("prefix" => "Two", "path" => "Two")))
                     ->create();

        $this->assertEquals(
             array(
                "Zend_View_Helper_" => array(
                    "Zend/View/Helper/",
                    "One/"
                ),
                "Rend_View_Helper_" => array(
                    "Rend/View/Helper/"
                ),
                "Two_" => array(
                    "Two/"
                )
            ),
            $view->getHelperPaths()
        ); 
    }


    public function testScriptPathsAreConfigurable()
    {
        $view = $this->_factory
                     ->setScriptPaths(array("one/", "two/"))
                     ->create();

        $this->assertEquals(
            array("two/", "one/"),
            $view->getScriptPaths()
        );
    }

    public function testStrictVarsIsConfigurable()
    {
        $view = $this->_factory
                     ->setStrictVars(true)
                     ->create();

        $this->assertTrue(
            $this->readAttribute($view, "_strictVars")
        );
    }

}
