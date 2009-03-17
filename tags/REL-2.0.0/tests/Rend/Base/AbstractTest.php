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

/** Rend_Base_Abstract */
require_once "Rend/Base/Abstract.php";

/**
 * @category Rend
 * @subpackage UnitTest
 */
class Rend_Base_AbstractTest extends PHPUnit_Framework_TestCase
{

    /**
     *
     */
    public function testConfigurationCanBeDoneViaAZendConfigObject()
    {
        $base = new Test_Rend_Base_Abstract(new Zend_Config(array("test" => "one")));

        $this->assertEquals(
            $base->test,
            "one"
        );
    }

    /**
     *
     */
    public function testConfigurationCanBeDoneViaAnArray()
    {
        $base = new Test_Rend_Base_Abstract(array("test" => "one"));

        $this->assertEquals(
            $base->test,
            "one"
        );
    }

}

class Test_Rend_Base_Abstract extends Rend_Base_Abstract
{

    public $test;

    public function setTest($test)
    {
        $this->test = $test;
        return $this;
    }

}
