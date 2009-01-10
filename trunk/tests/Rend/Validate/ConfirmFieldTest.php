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
 * @since 1.0.0
 * @version $Id$
 */

/** Rend_Validate_ConfirmField */
require_once "Rend/Validate/ConfirmField.php";

/**
 * @category Rend
 * @subpackage UnitTest
 */
class Rend_Validate_ConfirmFieldTest extends PHPUnit_Framework_TestCase
{

    public function testConfirmationFieldCanBeSet()
    {
        $validate = new Rend_Validate_ConfirmField();

        $validate->setField("test");

        $this->assertEquals(
            "test",
            $validate->getField()
        );
    }

    public function testAValidCanBeComparedAgainstAContextArray()
    {
        $validate = new Rend_Validate_ConfirmField("test");

        $this->assertTrue(
            $validate->isValid(
            	"test",
                array("test" => "test")
            )
        );
    }

    public function testAValidCanBeComparedAgainstAContextString()
    {
        $validate = new Rend_Validate_ConfirmField("test");

        $this->assertTrue(
            $validate->isValid(
            	"test",
                "test"
            )
        );
    }

    public function testNonMatchingDataIsNotValid()
    {
        $validate = new Rend_Validate_ConfirmField();

        $this->assertFalse(
            $validate->isValid("test", "asdf")
        );
    }

}
