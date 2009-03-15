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

/** Rend_Validate_StringEquals */
require_once "Rend/Validate/StringEquals.php";

/**
 * @category Rend
 * @subpackage UnitTest
 */
class Rend_Validate_StringEqualsTest extends PHPUnit_Framework_TestCase
{

    /**
     *
     */
    public function testTwoStringsCanBeCompared()
    {
        $validator = new Rend_Validate_StringEquals();
        $this->assertTrue($validator->isValid(array("one", "one")));

        $validator = new Rend_Validate_StringEquals();
        $this->assertFalse($validator->isValid(array("one", "two")));
    }

}
