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

/** Rend_Controller_Front */
require_once 'Rend/Controller/Front.php';

/** Rend_Controller_Request_Http */
require_once 'Rend/Controller/Request/Http.php';

/** Zend_Acl */
require_once 'Zend/Acl.php';

/** Zend_Acl_Resource */
require_once 'Zend/Acl/Resource.php';

/** Zend_Acl_Role */
require_once 'Zend/Acl/Role.php';

/** Rend_Controller_Action */
require_once 'Zend/Controller/Action.php';

/** Zend_Controller_Response_Cli */
require_once 'Zend/Controller/Response/Cli.php';

/**
 *
 */
class Rend_Controller_Action_Helper_IsAllowedTest extends PHPUnit_Framework_TestCase
{

    public function tearDown()
    {
        Rend_Controller_Front::getInstance()->resetInstance();
        Zend_Controller_Action_HelperBroker::resetHelpers();
    }

    public function testConstructorCanSetTheAclAndRole()
    {
        $acl  = new Zend_Acl();
        $role = 'test';

        $helper = $this->_getHelper($acl, $role);

        $this->assertSame($acl, $helper->getAcl());
        $this->assertEquals('test', $helper->getRole());
    }

    public function testAclIsLazyLoaded()
    {
        $aclHelper = new Rend_Controller_Action_Helper_Acl(
            dirname(__FILE__) . '/_files/acl.php'
        );

        Zend_Controller_Action_HelperBroker::addHelper($aclHelper);

        $isAllowedHelper = new Rend_Controller_Action_Helper_IsAllowed();

        $this->assertEquals(
            $aclHelper->getAcl(),
            $isAllowedHelper->getAcl()
        );
    }

    public function testAclCanBeOverwritten()
    {
        $acl = new Zend_Acl();

        $helper = new Rend_Controller_Action_Helper_Acl();
        $helper->setAcl($acl);

        $this->assertSame(
            $acl,
            $helper->getAcl()
        );
    }

    public function testRoleCanBeOverwritten()
    {
        $helper = new Rend_Controller_Action_Helper_IsAllowed();
        $helper->setRole('test');

        $this->assertEquals(
            'test',
            $helper->getRole()
        );
    }

    public function testAccessIsGrantedWhenNoAclsAreDefined()
    {
        $helper = $this->_getHelper($this->_getAcl());
        $helper->preDispatch();
    }

    public function testAccessIsGrantedWhenNoAclMappingIsDefinedForAnAction() {
        $helper = $this->_getHelper($this->_getAcl());
        $helper->getActionController()->acls = array();
        $helper->preDispatch();
    }

    public function testAccessIsGrantedWhenAclsHaveBeenDisabledOnAnAction()
    {
        $helper = $this->_getHelper($this->_getAcl());
        $helper->getActionController()->acls = array(
            'test' => Rend_Controller_Action_Helper_IsAllowed::DISABLE_ACL
        );
        $helper->getRequest()->setParam('action', 'test');
        $helper->preDispatch();
    }

    public function testAccessIsGrantedWhenARoleHasPermissionOnAnAction()
    {
        $helper = $this->_getHelper($this->_getAcl());
        $helper->getActionController()->acls = array(
            'test1' => array('comments', 'edit'),
            'test2' => array('news', 'delete')
        );

        $helper->getRequest()->setParam('action', 'test1');
        $helper->setRole('guest');
        $helper->preDispatch();

        $helper->getRequest()->setParam('action', 'test2');
        $helper->setRole('admin');
        $helper->preDispatch();
    }

    public function testAccessIsDeniedWhenAuthenticationIsRequiredToAccessAnAction()
    {
        $this->setExpectedException('Rend_Controller_Action_Exception_Auth');

        $helper = $this->_getHelper($this->_getAcl());
        $helper->getActionController()->acls = array(
            'test' => array('news')
        );
        $helper->getRequest()->setParam('action', 'test');
        $helper->preDispatch();
    }

    public function testAccessIsDeniedWhenARoleDoesNotHaveSufficientPrivilegesToAccessAnAction()
    {
        $this->setExpectedException('Rend_Controller_Action_Exception_Acl');

        $helper = $this->_getHelper($this->_getAcl());
        $helper->getActionController()->acls = array(
            'test' => array('news', 'edit')
        );
        $helper->getRequest()->setParam('action', 'test');
        $helper->setRole('guest');
        $helper->preDispatch();
    }

    public function testAccessIsGrantedWhenRoleHasPermissionAndAllActionsAreApplied()
    {
        $helper = $this->_getHelper($this->_getAcl());
        $helper->getActionController()->acls = array(
            Rend_Controller_Action_Helper_IsAllowed::ALL_ACTIONS => array('comments', 'edit')
        );
        $helper->getRequest()->setParam('action', 'test');
        $helper->setRole('guest');
        $helper->preDispatch();
    }

    public function testAccessIsGrantedWhenAllActionsHaveAclsDisabled()
    {
        $helper = $this->_getHelper($this->_getAcl());
        $helper->getActionController()->acls = array(
            Rend_Controller_Action_Helper_IsAllowed::ALL_ACTIONS => Rend_Controller_Action_Helper_IsAllowed::DISABLE_ACL
        );
        $helper->getRequest()->setParam('action', 'test');
        $helper->setRole('guest');
        $helper->preDispatch();
    }

    private function _getAcl()
    {
        $acl = new Zend_Acl();
        $acl->add(new Zend_Acl_Resource('news'));
        $acl->add(new Zend_Acl_Resource('comments'));
        $acl->addRole(new Zend_Acl_Role('admin'));
        $acl->addRole(new Zend_Acl_Role('guest'));
        $acl->allow('admin');
        $acl->allow('guest', 'comments');

        return $acl;
    }

    private function _getHelper(Zend_Acl $acl = null, $role = null)
    {
        $helper = new Rend_Controller_Action_Helper_IsAllowed(
            $acl,
            $role
        );

        $helper->setActionController(new MockAclHelperController(
            new Rend_Controller_Request_Http(),
            new Zend_Controller_Response_Cli()
        ));

        return $helper;
    }

}

class MockAclHelperController extends Zend_Controller_Action
{
}
