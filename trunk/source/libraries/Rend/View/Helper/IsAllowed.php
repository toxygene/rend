<?php
/**
 * Rend
 *
 * This source file is subject to the new BSD license that is bundled
 * with this package in the file LICENSE.txt.
 * It is also available through the world-wide-web at this URL:
 * http://rend.superglobals.com/license/new-bsd
 * If you did not receive a copy of the license and are unable to
 * obtain it through the world-wide-web, please send an email
 * to justin.hendrickson+rend@gmail.com so I can send you a copy immediately.
 *
 * @category    Rend
 * @package     View
 * @copyright   2008 Justin Hendrickson
 * @license     http://rend.superglobals.com/license/new-bsd    New BSD License
 * @link        http://rend.superglboals.com/
 * @since       1.0.0
 * @version     $Id$
 */

/** Zend_Controller_Action_HelperBroker */
require_once 'Zend/Controller/Action/HelperBroker.php';

/**
 * Acls rule checking helper
 *
 * @category    Rend
 * @package     View
 */
class Rend_View_Helper_IsAllowed
{

    /**
     * ACL object
     * @var     Zend_Acl
     */
    private $_acl;

    /**
     * Role name
     * @var     string
     */
    private $_role;

    /**
     * Check the ACLs to see if the currently logged in user has permission to
     * access the requested resource
     *
     * @param   string  $resource
     * @param   string  $permission
     * @return  boolean
     */
    public function isAllowed($resource, $permission = null)
    {
        if (!Zend_Controller_Action_HelperBroker::hasHelper('isAllowed')) {
            /** Zend_View_Exception */
            require_once 'Zend/View/Exception.php';
            throw new Zend_View_Exception('ACL helper is not loaded');
        }

        $role = $this->getRole();

        if (!$role) {
            return false;
        }

        return $this->getAcl()->isAllowed($role, $resource, $permission);
    }

    /**
     * Get the ACL object
     *
     * @return Zend_Acl
     */
    public function getAcl()
    {
        if (!$this->_acl) {
            $this->_acl = Zend_Controller_Action_HelperBroker::getExistingHelper('isAllowed')
                                                             ->getAcl();
        }

        return $this->_acl;
    }

    /**
     * Set the ACL object
     *
     * @param   Zend_Acl    $acl
     * @return  Rend_View_Helper_IsAllowed
     */
    public function setAcl(Zend_Acl $acl)
    {
        $this->_acl = $acl;
        return $this;
    }

    /**
     * Get the role
     *
     * @return  string
     */
    public function getRole()
    {
        if (!$this->_role) {
            $this->_role = Zend_Controller_Action_HelperBroker::getExistingHelper('isAllowed')
                                                              ->getRole();
        }

        return $this->_role;
    }

    /**
     * Set the role
     *
     * @param   string  $role
     * @return  Rend_View_Helper_IsAllowed
     */
    public function setRole($role)
    {
        $this->_role = $role;
        return $this;
    }

}
