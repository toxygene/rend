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

/** TestHelper */
require_once dirname(dirname(dirname(dirname(__FILE__)))) . '/TestHelper.php';

/**
 *
 */
class Rend_View_Helper_TruncateTest extends PHPUnit_Framework_TestCase
{

    private $_truncate;

    public function setup()
    {
        $this->_truncate = new Rend_View_Helper_Truncate();
    }

    public function tearDown()
    {
        unset($this->_truncate);
    }

    public function testExceptionIsThrownWhenLengthIsNegative()
    {
        $this->setExpectedException('InvalidArgumentException');

        $this->_truncate->truncate('test', -1);
    }

    public function testByDefaultTheStringIsCutAndDotsAreAdded()
    {
        $this->assertEquals(
            'this is m...',
            $this->_truncate->truncate('this is my test', 9)
        );
    }

    public function testEndValueIsAppendedToTheString()
    {
        $this->assertEquals(
            'this is m (more)',
            $this->_truncate->truncate('this is my test', 9, ' (more)')
        );
    }

    public function testTheBoundryParameterForcesCuttingOnlyAtWordBoundries()
    {
        $this->assertEquals(
            'this is...',
            $this->_truncate->truncate('this is my test', 9, '...', true)
        );
    }

}
