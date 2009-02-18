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

/** Rend_View_Helper_Truncate */
require_once "Rend/View/Helper/Truncate.php";

/**
 * @category Rend
 * @subpackage UnitTest
 */
class Rend_View_Helper_TruncateTest extends PHPUnit_Framework_TestCase
{

    private $_helper;

    protected function setUp()
    {
        $this->_helper = new Rend_View_Helper_Truncate();
    }

    public function testNegativeLengthThrowsAnException()
    {
        $this->setExpectedException("InvalidArgumentException");

        $this->_helper
             ->direct("", -1);
    }

    public function testShortStringsAreNotChanged()
    {
        $this->assertEquals(
            "short string",
            $this->_helper
                 ->direct("short string", 80)
        );
    }

    public function testLongStringsAreTruncatedWithEndCharacter()
    {
        $this->assertEquals(
            "short str---",
            $this->_helper
                 ->direct("short string", 9, "---")
        );
    }

    public function testLongStringsCanBeTruncatedOnBoundaries()
    {
        $this->assertEquals(
            "short---",
            $this->_helper
                 ->direct("short string", 9, "---", true)
        );
    }

    public function testMultibyteStringsCanBeTruncated()
    {
        $this->assertEquals(
            "éíÑÍ",
            $this->_helper
                 ->setEncoding("UTF-8")
                 ->direct("éíÑÍÉáÍÍéíÑÍÉáÍÍéáÍÍéíÑÍÉ", 4, "")
        );
    }

}
