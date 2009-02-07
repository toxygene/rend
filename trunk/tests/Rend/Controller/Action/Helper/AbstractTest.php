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

/** TestHelper */
require_once dirname(dirname(dirname(dirname(dirname(__FILE__))))) . "/TestHelper.php";

/** Rend_Controller_Action_Helper_Abstract */
require_once "Rend/Controller/Action/Helper/Abstract.php";

/** Rend_FactoryLoader */
require_once "Rend/FactoryLoader.php";

/**
 * @category Rend
 * @subpackage UnitTest
 */
class Rend_Controller_Action_Helper_AbstractTest extends PHPUnit_Framework_TestCase
{

    private $_helper;

    public function setUp()
    {
        $this->_helper = $this->getMock(
            "Rend_Controller_Action_Helper_Abstract",
            null
        );
    }

    public function testFactoryLoaderCanBeManuallyOverriden()
    {
        $factoryLoader = new Rend_FactoryLoader();

        $this->_helper->setFactoryLoader($factoryLoader);

        $this->assertSame(
            $factoryLoader,
            $this->_helper->getFactoryLoader()
        );
    }

    public function testFactoryLoaderIsLazyLoadedFromTheFrontController()
    {
        $factoryLoader = new Rend_FactoryLoader();

        $this->_helper->setActionController(new RCAHA_Test_Controller(
            new Zend_Controller_Request_Simple(),
            new Zend_Controller_Response_Cli(),
            array("rendFactoryLoader" => $factoryLoader)
        ));

        $this->assertSame(
            $factoryLoader,
            $this->_helper->getFactoryLoader()
        );
    }

    public function testConfigurationCanBeDoneWithAZendConfigObject()
    {
        $test = new RCAHA_Test_Helper(new Zend_Config(array(
            "test" => "test"
        )));

        $this->assertEquals(
            "test",
            $test->test
        );
    }

    public function testConfigurationCanBeDoneWithAnArray()
    {
        $test = new RCAHA_Test_Helper(array(
            "test" => "test"
        ));

        $this->assertEquals(
            "test",
            $test->test
        );
    }

}

class RCAHA_Test_Helper extends Rend_Controller_Action_Helper_Abstract
{

    public $test;

    public function setTest($test)
    {
        $this->test = $test;
    }

}

class RCAHA_Test_Controller extends Rend_Controller_Action
{
}
