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

/** Rend_Controller_Action_Helper_IsAllowed */
require_once "Rend/Controller/Action/Helper/IsAllowed.php";

/** Zend_Acl */
require_once "Zend/Acl.php";

/** Zend_Acl_Resource */
require_once "Zend/Acl/Resource.php";

/** Zend_Acl_Role */
require_once "Zend/Acl/Role.php";

/**
 * @category Rend
 * @subpackage UnitTest
 */
class Rend_Controller_Action_Helper_IsAllowedTest extends PHPUnit_Framework_TestCase
{

    private $_helper;

    private function _getAcl()
    {
        $acl = new Zend_Acl();

        $acl->add(new Zend_Acl_Resource("apple"))
            ->add(new Zend_Acl_Resource("pear"))
            ->addRole(new Zend_Acl_Role("john"))
            ->addRole(new Zend_Acl_Role("mike"));

        $acl->allow("john", "apple", "eat")
            ->allow("john", "pear")
            ->allow("mike", "apple", "touch");

        return $acl;
    }

    public function setUp()
    {
        $actionController = new IsAllowed_Zend_Controller_Action(
            new Zend_Controller_Request_Simple(),
            new Zend_Controller_Response_Cli()
        );

        $this->_helper = new Rend_Controller_Action_Helper_IsAllowed(array(
            "acl"              => $this->_getAcl(),
            "actionController" => $actionController
        ));
    }

    public function testAclsCanBeDirectlyChecked()
    {
        $this->assertTrue(
            $this->_helper
                 ->setRole("mike")
                 ->isAllowed("apple", "touch")
        );

        $this->assertFalse(
            $this->_helper
                 ->isAllowed("pear", "eat")
        );
    }

    public function testRulesCanBeManuallySet()
    {
        $this->_helper->setRules(array(
            "one" => array("apple", "eat"),
            "two" => array("pear"),
            array(
                "action"     => "three",
                "resource"   => "apple",
                "permission" => "discard"
            ),
            "four" => array(),
            array(
                "five",
                "pear",
                "discard"
            )
        ));

        $this->assertEquals(
            array(
                "one"   => array("apple", "eat"),
                "two"   => "pear",
                "three" => array("apple", "discard"),
                "five"  => array("pear", "discard")
            ),
            $this->_helper->getRules()
        );
    }

    public function testRuleCanBeCleared()
    {
        $this->_helper->clearRules();

        $this->assertEquals(
            array(),
            $this->_helper->getRules()
        );
    }

    public function testRulesCanBeChecked()
    {
        $this->_helper->addRules(array(
            "one" => array("apple", "eat")
        ));

        $this->assertTrue($this->_helper->hasRule("one"));
        $this->assertFalse($this->_helper->hasRule("two"));
    }

    public function testRulesCanBeRemoved()
    {
        $this->_helper->addRules(array(
            "one" => array("apple", "eat")
        ));

        $this->assertTrue($this->_helper->hasRule("one"));

        $this->_helper->removeRule("one");

        $this->assertFalse($this->_helper->hasRule("one"));
    }

    public function testRulesCanBeFetched()
    {
        $this->_helper->addRules(array(
            "one" => array("apple", "eat"),
            "two" => "*",
        	"*"   => "*"
        ));

        $this->assertEquals(
            array("apple", "eat"),
            $this->_helper->getRule("one")
        );

        $this->assertNull($this->_helper->getRule("two"));
        $this->assertNull($this->_helper->getRule("three"));
    }

    public function testUnauthorizedErrorRedirectsToUnauthorizedPage()
    {
        $this->_helper
             ->getActionController()
             ->getRequest()
             ->setActionName("one");

        $this->_helper
             ->addRule("one", "apple", "eat")
             ->preDispatch();

        $this->assertEquals(
            array(
                "deniedAction"     => "one",
                "deniedResource"   => "apple",
                "deniedPermission" => "eat",
                "deniedParameters" => array()
            ),
            $this->_helper
                 ->getActionController()
                 ->getRequest()
                 ->getParams()
        );

        $this->assertEquals(
            "unauthorized",
            $this->_helper
                 ->getActionController()
                 ->getRequest()
                 ->getActionName()
        );

        $this->assertEquals(
            "error",
            $this->_helper
                 ->getActionController()
                 ->getRequest()
                 ->getControllerName()
        );

        $this->assertEquals(
            "default",
            $this->_helper
                 ->getActionController()
                 ->getRequest()
                 ->getModuleName()
        );
    }

    public function testUnauthorizedPageRedirectionCanBeConfigured()
    {
        $this->_helper
             ->getActionController()
             ->getRequest()
             ->setActionName("one");

        $this->_helper
             ->addRule("one", "apple", "eat")
             ->setUnauthorizedAction("unauthorizedAction")
             ->setUnauthorizedController("unauthorizedController")
             ->setUnauthorizedModule("unauthorizedModule")
             ->setUnauthorizedParameters(array("one" => "two"))
             ->preDispatch();

        $this->assertEquals(
            "unauthorizedAction",
            $this->_helper
                 ->getActionController()
                 ->getRequest()
                 ->getActionName()
        );

        $this->assertEquals(
            "unauthorizedController",
            $this->_helper
                 ->getActionController()
                 ->getRequest()
                 ->getControllerName()
        );

        $this->assertEquals(
            "unauthorizedModule",
            $this->_helper
                 ->getActionController()
                 ->getRequest()
                 ->getModuleName()
        );

        $this->assertEquals(
            "two",
            $this->_helper->getActionController()->getRequest()->getParam("one")
        );
    }

    public function testForbiddenErrorRedirectToForbiddenPage()
    {
        $this->_helper
             ->getActionController()
             ->getRequest()
             ->setActionName("one");

        $this->_helper
             ->setRole("mike")
             ->addRule("one", "apple", "eat")
             ->preDispatch();

        $this->assertEquals(
            array(
                "deniedAction"     => "one",
                "deniedParameters" => array(),
                "deniedResource"   => "apple",
                "deniedPermission" => "eat",
                "deniedRole"       => "mike"
            ),
            $this->_helper
                 ->getActionController()
                 ->getRequest()
                 ->getParams()
        );

        $this->assertEquals(
            "forbidden",
            $this->_helper
                 ->getActionController()
                 ->getRequest()
                 ->getActionName()
        );

        $this->assertEquals(
            "error",
            $this->_helper
                 ->getActionController()
                 ->getRequest()
                 ->getControllerName()
        );

        $this->assertEquals(
            "default",
            $this->_helper
                 ->getActionController()
                 ->getRequest()
                 ->getModuleName()
        );
    }

    public function testForbiddenPageRedirectionCanBeConfigured()
    {
        $this->_helper
             ->getActionController()
             ->getRequest()
             ->setActionName("one");

        $this->_helper
             ->setRole("mike")
             ->addRule("one", "apple", "eat")
             ->setForbiddenAction("forbiddenAction")
             ->setForbiddenController("forbiddenController")
             ->setForbiddenModule("forbiddenModule")
             ->setForbiddenParameters(array("one" => "two"))
             ->preDispatch();

        $this->assertEquals(
            "forbiddenAction",
            $this->_helper
                 ->getActionController()
                 ->getRequest()
                 ->getActionName()
        );

        $this->assertEquals(
            "forbiddenController",
            $this->_helper
                 ->getActionController()
                 ->getRequest()
                 ->getControllerName()
        );

        $this->assertEquals(
            "forbiddenModule",
            $this->_helper
                 ->getActionController()
                 ->getRequest()
                 ->getModuleName()
        );

        $this->assertEquals(
            "two",
            $this->_helper->getActionController()->getRequest()->getParam("one")
        );
    }

    public function testExceptionsCanBeThrown()
    {
        $this->setExpectedException("Zend_Controller_Action_Exception");

        $this->_helper
             ->getActionController()
             ->getRequest()
             ->setActionName("one");

        $this->_helper
             ->setThrowExceptions(true)
             ->addRule("one", "apple", "eat")
             ->preDispatch();
    }

    public function testAccessIsAllowedIfThereIsNoRule()
    {
        $this->_helper
             ->setThrowExceptions(true)
             ->preDispatch();
    }

    public function testAclsCanBeManuallyOverridden()
    {
        $acl = new Zend_Acl();

        $this->_helper->setAcl($acl);

        $this->assertAttributeSame(
            $acl,
            "_acl",
            $this->_helper
        );
    }

    public function testAclsAreLazyLoadedFromTheFactoryLoader()
    {
        $acl = $this->_getAcl();

        $helper = new Rend_Controller_Action_Helper_IsAllowed();
        $helper->setFactoryLoader(new Rend_FactoryLoader(array(
            "factories" => array(
                "acl" => new RCAHIA_Test_Factory($acl)
            )
        )));

        $this->assertSame(
            $acl,
            $helper->getAcl()
        );
    }

    public function testAnExceptionIsThrownWhenTheAclCannotBeLazyLoadedFromTheFactoryLoader()
    {
        $this->setExpectedException("Zend_Controller_Action_Exception");

        $helper = new Rend_Controller_Action_Helper_IsAllowed();
        $helper->setFactoryLoader(new Rend_FactoryLoader(array(
            "factories" => array(
                "acl" => new RCAHIA_Test_NonAcl_Factory()
            )
        )));

        $helper->getAcl();
    }

    public function testRuleKeyCanBeChanged()
    {
        $this->_helper
             ->setRuleKey("asdf")
             ->addRule("one", "two");

        $actionController = $this->_helper
                                 ->getActionController();

        $this->assertTrue(
            isset($actionController->asdf)
        );
    }

    /**
     * @see http://code.google.com/p/rend/issues/detail?id=28
     */
    public function testDispatchingToAnActionWithARuleThatOnlyRequiresAResourceWorks()
    {
        $this->_helper
             ->getActionController()
             ->getRequest()
             ->setActionName("one");

        $this->_helper
             ->addRule("one", "apple")
             ->preDispatch();

        $this->assertFalse($this->_helper->getActionController()->getRequest()->isDispatched());
    }

}

class IsAllowed_Zend_Controller_Action extends Zend_Controller_Action
{
}

class RCAHIA_Test_Factory implements Rend_Factory_Acl_Interface
{

    private $_object;

    public function __construct($object)
    {
        $this->_object = $object;
    }

    public function create()
    {
        return $this->_object;
    }

}

class RCAHIA_Test_NonAcl_Factory implements Rend_Factory_Interface
{
}
