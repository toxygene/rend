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

/** Rend_Controller_Action_Helper_LayoutSelector */
require_once "Rend/Controller/Action/Helper/LayoutSelector.php";

/**
 * @category Rend
 * @subpackage UnitTest
 */
class Rend_Controller_Action_Helper_LayoutSelectorTest extends PHPUnit_Framework_TestCase
{

    private $_helper;

    public function setUp()
    {
        $actionController = new RCAHLS_Controller(
            new Zend_Controller_Request_Simple(),
            new Zend_Controller_Response_Cli()
        );

        $this->_helper = new Rend_Controller_Action_Helper_LayoutSelector(array(
            "actionController" => $actionController
        ));
    }

    public function testLayoutsCanBeFetched()
    {
        $this->assertEquals(
            array(),
            $this->_helper
                 ->getActionLayouts()
        );

        $this->_helper
             ->addActionLayout("one", "two");

        $this->assertEquals(
            "two",
            $this->_helper
                 ->getActionLayout("one")
        );

        $this->assertNull(
            $this->_helper
                 ->getActionLayout("three")
        );
    }

    public function testLayoutsCanBeManuallySet()
    {
        $this->_helper->setActionLayouts(array(
            "one" => "two",
            "three" => "four"
        ));

        $this->assertEquals(
            array(
                "one" => "two",
                "three" => "four"
            ),
            $this->_helper->getActionLayouts()
        );
    }

    public function testActionLayoutKeyCanBeChanged()
    {
        $this->_helper
             ->setActionLayoutKey("asdf")
             ->addActionLayout("one", "two");

        $this->assertEquals(
            array("one" => "two"),
            $this->_helper->getActionController()->asdf
        );
    }

    public function testLayoutCanBeManuallyOverridden()
    {
        $layout = new Zend_Layout();

        $this->_helper
             ->setLayout($layout);

        $this->assertSame(
            $layout,
            $this->_helper
                 ->getLayout()
        );
    }

    public function testLayoutIsLazyLoadedFromTheLayoutActionHelper()
    {
        $layout = new Zend_Layout();

        Zend_Controller_Action_HelperBroker::addHelper(new Zend_Layout_Controller_Action_Helper_Layout(
            $layout
        ));

        $this->assertSame(
            $layout,
            $this->_helper
                 ->getLayout()
        );
    }

    public function testLayoutScriptIsSetOnPostDispatch()
    {
        $this->_helper
             ->getRequest()
             ->setDispatched(true)
             ->setActionName("one");

        $this->_helper
             ->addActionLayout("one", "two")
             ->postDispatch();

        $this->assertEquals(
            "two",
            $this->_helper
                 ->getLayout()
                 ->getLayout()
        );
    }

    public function testWildcardsCanBeUsedForLayouts()
    {
        $this->_helper
             ->getRequest()
             ->setDispatched(true)
             ->setActionName("one");

        $this->_helper
             ->addActionLayout(Rend_Controller_Action_Helper_LayoutSelector::WILDCARD, "two")
             ->postDispatch();

        $this->assertEquals(
            "two",
            $this->_helper
                 ->getLayout()
                 ->getLayout()
        );
    }

}

class RCAHLS_Controller extends Zend_Controller_Action
{
}
