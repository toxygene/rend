<?php
/**
 * Rend
 *
 * LICENSE
 *
 * This source file is subject to the new BSD license that is bundled
 * with this package in the file LICENSE.txt.
 * It is also available through the world-wide-web at this URL:
 * http://rend.superglobals.com/License
 * If you did not receive a copy of the license and are unable to
 * obtain it through the world-wide-web, please send an email
 * to justin.hendrickson+rend@gmail.com so I can send you a copy immediately.
 *
 * @category   Rend
 * @package    Tests
 * @copyright  Copyright (c) 2005-2007 Zend Technologies USA Inc. (http://rend.superglobals.com)
 * @license    http://rend.superglobals.com/License New BSD License
 * @version    $Id$
 */

/** Rend_Validate_StringEquals */
require_once 'Rend/Validate/StringEquals.php';

/**
 *
 */
class Rend_Validate_StringEqualsTest extends PHPUnit_Framework_TestCase
{

    public function setUp()
    {
        $this->_validator = new Rend_Validate_StringEquals();
    }

    public function tearDown()
    {
        unset($this->_validator);
    }

    public function testEqualStringsValidate()
    {
        $this->assertTrue($this->_validator->isValid(array('one', 'one')));
    }

    public function testUnequalStringsDoNotValidate()
    {
        $this->assertFalse($this->_validator->isValid(array('one', 'two')));
        $this->assertEquals(array(Rend_Validate_StringEquals::NOT_EQUALS), $this->_validator->getErrors());
    }

}
