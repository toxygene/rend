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

/** Rend_View_Helper_Cycle */
require_once 'Rend/View/Helper/Cycle.php';

/**
 *
 */
class Rend_View_Helper_CycleTest extends PHPUnit_Framework_TestCase
{

    private $_helper;

    public function setup()
    {
        $this->_helper = new Rend_View_Helper_Cycle();
    }

    public function tearDown()
    {
        Rend_View_Helper_Cycle::resetCycles();

        unset($this->_helper);
    }

    /**
     *
     */
    public function testMultipleCycleCallsReturnSubsequentValues()
    {
        $selections = array('one', 'two', 'three');

        for ($i = 0; $i < count($selections) * 2 + 1; ++$i) {
            $this->assertEquals($selections[$i % 3], $this->_helper->cycle($selections));
        }
    }

    /**
     *
     */
    public function testMultipleCycleCallsWithoutSwitchingReturnTheSameValue()
    {
        $selections = array('one', 'two', 'three');

        $this->assertEquals($selections[0], $this->_helper->cycle($selections, 'default', false));
        $this->assertEquals($selections[0], $this->_helper->cycle($selections, 'default', false));
    }

    /**
     *
     */
    public function testCyclingWithDifferentNamedSelectionsIsSupported()
    {
        $one = array('one', 'two', 'three');
        $two = array('four', 'five', 'six');

        $this->assertEquals('one', $this->_helper->cycle($one, 'selection_1'));
        $this->assertEquals('four', $this->_helper->cycle($two, 'selection_2'));
        $this->assertEquals('two', $this->_helper->cycle($one, 'selection_1'));
        $this->assertEquals('five', $this->_helper->cycle($two, 'selection_2'));
        $this->assertEquals('three', $this->_helper->cycle($one, 'selection_1'));
        $this->assertEquals('six', $this->_helper->cycle($two, 'selection_2'));
        $this->assertEquals('one', $this->_helper->cycle($one, 'selection_1'));
        $this->assertEquals('four', $this->_helper->cycle($two, 'selection_2'));
    }

}
