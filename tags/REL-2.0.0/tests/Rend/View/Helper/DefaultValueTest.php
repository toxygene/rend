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

/** Rend_View_Helper_DefaultValue */
require_once "Rend/View/Helper/DefaultValue.php";

/**
 * @category Rend
 * @subpackage UnitTest
 */
class Rend_View_Helper_DefaultValueTest extends PHPUnit_Framework_TestCase
{

    private $_helper;

    public function setUp()
    {
        $this->_helper = new Rend_View_Helper_DefaultValue();
    }

    public function testValueReturnedIsBasedOnIfTheInitialValueIsSetOrNot()
    {
        $this->assertEquals("one", $this->_helper->defaultValue("one", "two"));
        $this->assertEquals("two", $this->_helper->direct(false, "two"));
    }

    public function testDirectMethodProxiesToTheDefaultValueMethod()
    {
        $this->assertEquals("one", $this->_helper->direct("one", "two"));
    }

}
