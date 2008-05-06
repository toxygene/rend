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

/** Rend_Controller_Action_Helper_LayoutSelector */
require_once 'Rend/Controller/Action/Helper/LayoutSelector.php';

/** Rend_Controller_Front */
require_once 'Rend/Controller/Front.php';

/** Rend_Controller_Request_Http */
require_once 'Rend/Controller/Request/Http.php';

/** Zend_Controller_Action */
require_once 'Zend/Controller/Action.php';

/** Zend_Controller_Action_HelperBroker */
require_once 'Zend/Controller/Action/HelperBroker.php';

/** Zend_Controller_Response_Cli */
require_once 'Zend/Controller/Response/Cli.php';

/** Zend_Layout */
require_once 'Zend/Layout.php';

/**
 *
 */
class Rend_Controller_Action_Helper_LayoutSelectorTest extends PHPUnit_Framework_TestCase
{

    private $_helper;

    public function setUp()
    {
        $this->_helper = new Rend_Controller_Action_Helper_LayoutSelector();

        $this->_helper->setActionController(new MockLayoutSelectorHelperController(
            new Rend_Controller_Request_Http(),
            new Zend_Controller_Response_Cli()
        ));

        $this->_helper->getFrontController()->addControllerDirectory('_files/test_module', 'test_module');
    }

    public function tearDown()
    {
        Rend_Controller_Front::getInstance()->resetInstance();
        Zend_Controller_Action_HelperBroker::resetHelpers();

        unset($this->_helper);
    }

    public function testConstructorCanSetTheLayout()
    {
        $layout = new Zend_Layout(null, false);

        $helper = new Rend_Controller_Action_Helper_LayoutSelector($layout);

        $this->assertSame(
            $layout,
            $helper->getLayout()
        );
    }

    public function testLayoutIsLazyLoaded()
    {
        $layout = new Zend_Layout(null, true);

        $this->assertSame(
            $layout,
            $this->_helper->getLayout()
        );
    }

    public function testLayoutCanBeOverwritten()
    {
        $layout = new Zend_Layout(null, false);

        $this->_helper->setLayout($layout);

        $this->assertSame(
            $layout,
            $this->_helper->getLayout()
        );
    }

    public function testSettingALayoutInThisModuleChangesTheLayoutScript()
    {
        $this->_helper->setLayout(new Zend_Layout(null, true));
        $this->_helper->getActionController()->layouts = array(
            'test' => 'test_layout.phtml'
        );
        $this->_helper->getRequest()->setActionName('test');
        $this->_helper->preDispatch();

        $this->assertEquals('test_layout.phtml', $this->_helper->getLayout()->getLayout());
        $this->assertEquals('', $this->_helper->getLayout()->getLayoutPath());
    }

    public function testSettingALayoutInAnotherModuleChangesTheLayoutScriptAndPath()
    {
        $this->_helper->setLayout(new Zend_Layout(null, true));
        $this->_helper->getActionController()->layouts = array(
            'test' => array('test_layout.phtml', 'test_module')
        );
        $this->_helper->getRequest()->setActionName('test');
        $this->_helper->preDispatch();

        $this->assertEquals('test_layout.phtml', $this->_helper->getLayout()->getLayout());
        $this->assertEquals('_files/test_module/views/scripts', $this->_helper->getLayout()->getLayoutPath());
    }

    public function testZendLayoutDefaultLayoutIsUsedWhenNoLayoutIsSpecified()
    {
        $this->_helper->setLayout(new Zend_Layout(null, true));
        $this->_helper->preDispatch();

        $this->assertEquals('layout', $this->_helper->getLayout()->getLayout());
    }

}

class MockLayoutSelectorHelperController extends Zend_Controller_Action
{
}
