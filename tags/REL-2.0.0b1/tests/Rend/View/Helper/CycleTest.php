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
 * @category    Rend
 * @subpackage 	UnitTest
 * @copyright   2008 Justin Hendrickson
 * @license     http://www.rendframework.com/license.html    New BSD License
 * @link        http://www.rendframework.com/
 * @since       2.0.0
 * @version     $Id$
 */

/** Rend_View_Helper_Cycle */
require_once "Rend/View/Helper/Cycle.php";

/**
 * @category    Rend
 * @subpackage 	UnitTest
 */
class Rend_View_Helper_CycleTest extends PHPUnit_Framework_TestCase
{

    private $_helper;

    public function setUp()
    {
        $this->_helper = new Rend_View_Helper_Cycle();
    }

    public function testCycleReturnsACycleIterator()
    {
        $this->assertType(
            "Rend_View_Helper_Cycle_Container",
            $this->_helper->direct(array("one"))
        );
    }

    public function testCycleContainerIteratesInfinitely()
    {
        $container = $this->_helper->direct(array("one", "two"));

        $this->assertEquals("one", $container->current());
        $container->next();

        $this->assertEquals("two", $container->current());
        $container->next();

        $this->assertEquals("one", $container->getCurrentAndAdvance());
        $this->assertEquals("two", $container->current());
    }

}
