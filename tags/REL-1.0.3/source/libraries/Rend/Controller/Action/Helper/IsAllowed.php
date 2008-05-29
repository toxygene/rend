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
 * @package     Controller
 * @copyright   2008 Justin Hendrickson
 * @license     http://rend.superglobals.com/license/new-bsd    New BSD License
 * @link        http://rend.superglboals.com/
 * @since       1.0.0
 * @version     $Id$
 */

/** Rend_Controller_Action_Helper_Abstract */
require_once 'Rend/Controller/Action/Helper/Abstract.php';

/**
 * @category    Rend
 * @package     Controller
 */
class Rend_Controller_Action_Helper_IsAllowed extends Rend_Controller_Action_Helper_Abstract
{

    /**
     * All actions wildcard
     * @var     string
     */
    const ALL_ACTIONS = '*';

    /**
     * Disable ACL wildcard
     * @var     string
     */
    const DISABLE_ACL = '*';

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
     * Constructor
     *
     * @param   Zend_Acl    $acl
     * @param   string      $role
     */
    public function __construct(Zend_Acl $acl = null, $role = null)
    {
        $this->_acl  = $acl;
        $this->_role = $role;
    }

    /**
     * Get the Acl object
     *
     * @return  Zend_Acl
     */
    public function getAcl()
    {
        if (!$this->_acl) {
            $this->_acl = $this->_getActionHelper('acl')->getAcl();
        }
        return $this->_acl;
    }

    /**
     * Get the role name
     *
     * @return  mixed
     */
    public function getRole()
    {
        return $this->_role;
    }

    /**
     * Set the role name
     *
     * @param   string  $role
     * @return  Rend_Controller_Action_Helper_Acl
     */
    public function setRole($role = null)
    {
        $this->_role = $role;
        return $this;
    }

    /**
     * Check the Acls for permission to the resource
     *
     * @throws  Rend_Controller_Action_Exception_Acl
     * @throws  Rend_Controller_Action_Exception_Auth
     */
    public function preDispatch()
    {
        list ($resource, $permission) = $this->_getRequiredResourceAndPermission($this->_getActionName());

        if (!$resource) {
            return;
        }

        $role = $this->getRole();

        if (!$role) {
            $permission = $permission ? $permission : '*';
            /** Rend_Controller_Action_Exception_Auth */
            require_once 'Rend/Controller/Action/Exception/Auth.php';
            throw new Rend_Controller_Action_Exception_Auth("Unauthenticated users cannot access action '{$this->_getActionName()}' (requires permission '{$permission}' on resource '{$resource}')");
        }

        if (!$this->getAcl()->isAllowed($role, $resource, $permission)) {
            $permission = $permission ? $permission : '*';
            /** Rend_Controller_Action_Exception_Acl */
            require_once 'Rend/Controller/Action/Exception/Acl.php';
            throw new Rend_Controller_Action_Exception_Acl("Role '{$role}' cannot access action '{$this->_getActionName()}' (requires permission '{$permission}' on resource '{$resource}')");
        }
    }

    /**
     * Determine the resource and permission required to access the requested
     * action
     *
     * @param   string  $actionName
     * @return  array
     * @todo    Replace temporary variables with queries
     * @todo    Decompose conditionals
     */
    private function _getRequiredResourceAndPermission($actionName) {
        $actionController = $this->getActionController();

        // Bail out if the controller doesn't have any ACL rules
        if (!isset($actionController->acls)) {
            return;
        }

        $acls = $actionController->acls;

        // Bail out if there are no rules that apply to this action
        if (!isset($acls[$actionName]) && !isset($acls[self::ALL_ACTIONS])) {
            return;
        }

        if (isset($acls[$actionName])) {
            // Bail out if this actions rule is disabled
            if ($acls[$actionName] == self::DISABLE_ACL) {
                return;
            }

            return $this->_formatAclResults($acls[$actionName]);
        } else {
            // Bail out if all actions rules are disabled
            if ($acls[self::ALL_ACTIONS] == self::DISABLE_ACL) {
                return;
            }

            return $this->_formatAclResults($acls[self::ALL_ACTIONS]);
        }
    }

    /**
     * Format the Acl results consistently
     *
     * @param   array   $results
     * @return  array
     */
    private function _formatAclResults($results)
    {
        if (isset($results[1])) {
            return $results;
        } else {
            return array(
                $results[0],
                null
            );
        }
    }

}
