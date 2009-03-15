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
 * @since 1.0.0
 * @version $Id$
 */

/** Rend_Filter_Null */
require_once "Rend/Filter/Null.php";

/**
 * @category    Rend
 * @subpackage  UnitTest
 */
class Rend_Filter_NullTest extends PHPUnit_Framework_TestCase
{

    private $_filter;

    public function setUp()
    {
        $this->_filter = new Rend_Filter_Null();
    }

    public function testFiltersNullValuesToNull()
    {
        $this->assertNull($this->_filter->filter(""));
        $this->assertNull($this->_filter->filter(0));
        $this->assertNull($this->_filter->filter(false));
        $this->assertNull($this->_filter->filter(null));
    }

    public function testDoesNotFilterNonNullValues()
    {
        $this->assertNotNull($this->_filter->filter("test"));
        $this->assertNotNull($this->_filter->filter(1));
        $this->assertNotNull($this->_filter->filter(true));
    }

}
