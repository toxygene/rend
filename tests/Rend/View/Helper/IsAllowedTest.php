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

/** Rend_Controller_Action_Helper_IsAllowed */
require_once 'Rend/Controller/Action/Helper/IsAllowed.php';

/** Rend_View_Helper_IsAllowed */
require_once 'Rend/View/Helper/IsAllowed.php';

/** Zend_Acl */
require_once 'Zend/Acl.php';

/** Zend_Acl_Resource */
require_once 'Zend/Acl/Resource.php';

/** Zend_Acl_Role */
require_once 'Zend/Acl/Role.php';

/**
 *
 */
class Rend_View_Helper_IsAllowedTest extends PHPUnit_Framework_TestCase
{

    private $_helper;

    public function setup()
    {
        $acl = new Zend_Acl();
        $acl->add(new Zend_Acl_Resource('news'));
        $acl->add(new Zend_Acl_Resource('comments'));
        $acl->addRole(new Zend_Acl_Role('admin'));
        $acl->addRole(new Zend_Acl_Role('guest'));
        $acl->allow('admin');
        $acl->allow('guest', 'comments');

        Zend_Controller_Action_HelperBroker::addHelper(new Rend_Controller_Action_Helper_IsAllowed(
            $acl
        ));

        $this->_helper = new Rend_View_Helper_IsAllowed();
    }

    public function tearDown()
    {
        Zend_Controller_Action_HelperBroker::resetHelpers();

        unset($this->_helper);
    }

    public function testReturnsTrueWhenTheRoleHasAccessToTheResource()
    {
        Zend_Controller_Action_HelperBroker::getExistingHelper('isAllowed')->setRole('guest');

        $this->assertTrue($this->_helper->isAllowed('comments', 'edit'));
    }

    public function testReturnsFalseWhenTheRoleDoesNotHaveAccessToTheResource()
    {
        Zend_Controller_Action_HelperBroker::getExistingHelper('isAllowed')->setRole('guest');

        $this->assertFalse($this->_helper->isAllowed('news', 'delete'));
    }

    public function testRoleIsOverloadable()
    {
        $this->assertNull($this->_helper->getRole());
        $this->assertSame(
            $this->_helper->setRole('test'),
            $this->_helper
        );
        $this->assertEquals('test', $this->_helper->getRole());
    }

    public function testAclIsOverloadable()
    {
        $acl = new Zend_Acl();

        $this->assertSame(
            $this->_helper->setAcl($acl),
            $this->_helper
        );
        $this->assertEquals($acl, $this->_helper->getAcl());
    }

}
