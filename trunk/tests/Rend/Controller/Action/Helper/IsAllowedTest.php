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

    public function setUp()
    {
        $actionController = $this->getMock("Zend_Controller_Action", array(), array(), '', false);
        $actionController->setRequest($this->getMock("Zend_Controller_Request_Abstract", array(), array(), '', false));

        $acl = new Zend_Acl();

        $acl->add(new Zend_Acl_Resource("apple"))
            ->add(new Zend_Acl_Resource("pear"))
            ->addRole(new Zend_Acl_Role("john"))
            ->addRole(new Zend_Acl_Role("mike"));

        $acl->allow("john", "apple", "eat")
            ->allow("john", "pear")
            ->allow("mike", "apple", "touch");

        $this->_helper = new Rend_Controller_Action_Helper_IsAllowed(array(
            "acl"              => $acl,
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

    /**
     *
     */
    public function testRulesCanBeManuallySet()
    {
        $this->_helper->addRules(array(
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
                "two"   => array("pear", ""),
                "three" => array("apple", "discard"),
                "five"  => array("pear", "discard")
            ),
            $this->_helper->getRules()
        );
    }

    /**
     *
     */
    public function testRuleCanBeCleared()
    {
        $this->_helper->clearRules();

        $this->assertEquals(
            array(),
            $this->_helper->getRules()
        );
    }

    /**
     *
     */
    public function testRulesCanBeChecked()
    {
        $this->_helper->addRules(array(
            "one" => array("apple", "eat")
        ));

        $this->assertTrue($this->_helper->hasRule("one"));
        $this->assertFalse($this->_helper->hasRule("two"));
    }

    /**
     *
     */
    public function testRulesCanBeRemoved()
    {
        $this->_helper->addRules(array(
            "one" => array("apple", "eat")
        ));

        $this->assertTrue($this->_helper->hasRule("one"));

        $this->_helper->removeRule("one");

        $this->assertFalse($this->_helper->hasRule("one"));
    }

    /**
     *
     */
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

        $this->assertEquals(
            array("pear", ""),
            $this->_helper->getRule("three")
        );
    }

}
