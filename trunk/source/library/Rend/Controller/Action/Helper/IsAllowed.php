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
 * @category    Rend
 * @package     Controller
 * @copyright   2008 Justin Hendrickson
 * @license     http://www.rendframework.com/license.html    New BSD License
 * @link        http://www.rendframework.com/
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
     * Deny action
     * @var     string
     */
    private $_denyAction;

    /**
     * Deny controller
     * @var     string
     */
    private $_denyController;

    /**
     * Deny module
     * @var     string
     */
    private $_denyModule;

    /**
     * Deny params
     * @var     array
     */
    private $_denyParams;

    /**
     * Role name
     * @var     string
     */
    private $_role;

    /**
     * Throw exceptions
     * @var     boolean
     */
    private $_throwExceptions = true;

    /**
     * Get the ACL object
     *
     * @return  Zend_Acl
     */
    public function getAcl()
    {
        if (!$this->_acl) {
            $this->_acl = $this->_getActionHelper('acl')
                               ->getAcl();
        }
        return $this->_acl;
    }

    /**
     * Get the role name
     *
     * @return  string
     */
    public function getRole()
    {
        return $this->_role;
    }

    /**
     * Initialize the helper
     */
    public function init()
    {
        $this->_denyAction = $this->getFrontController()
                                  ->getDispatcher()
                                  ->getDefaultAction();

        $this->_denyController = $this->getFrontController()
                                      ->getDispatcher()
                                      ->getDefaultControllerName();

        $this->_denyModule = $this->getFrontController()
                                  ->getDispatcher()
                                  ->getDefaultModule();

        $this->_denyParams = array();
    }

    /**
     * Set the ACL
     *
     * @param   Zend_Acl    $acl
     * @return  Rend_Controller_Action_Helper_IsAllowed
     */
    public function setAcl(Zend_Acl $acl)
    {
        $this->_acl = $acl;
        return $this;
    }

    /**
     * Set the deny page
     *
     * @param   string  $action
     * @param   string  $controller
     * @param   string  $module
     * @param   array   $params
     */
    public function setDenyPage($action, $controller = null, $module = null, $params = null)
    {
        $this->_denyAction     = $action;
        $this->_denyController = $controller;
        $this->_denyModule     = $module;
        $this->_denyParams     = $params;

        return $this;
    }

    /**
     * Set the role name
     *
     * @param   string  $role
     * @return  Rend_Controller_Action_Helper_IsAllowed
     */
    public function setRole($role = null)
    {
        $this->_role = $role;
        return $this;
    }

    /**
     * Enable/disable throwing exceptions
     *
     * @param   boolean     $flag
     * @return  Rend_Controller_Action_Helper_IsAllowed
     */
    public function setThrowExceptions($flag)
    {
        $this->_throwExceptions = (boolean) $flag;
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
        list ($resource, $permission) = $this->_getRequiredResourceAndPermission(
            $this->_getActionName()
        );

        if (!$resource) {
            return;
        }

        if (!$this->getAcl()->isAllowed($this->getRole(), $resource, $permission)) {
            $permission = $permission ? $permission : '*';

            if ($this->_throwExceptions) {
                /** Rend_Controller_Action_Exception_Acl */
                require_once 'Rend/Controller/Action/Exception/Acl.php';
                throw new Rend_Controller_Action_Exception_Acl("Role '{$this->getRole()}' cannot access action '{$this->_getActionName()}' (requires permission '{$permission}' on resource '{$resource}')");
            } else {
                $this->getRequest()
                     ->setParam('denyAction', $this->getRequest()->getActionName())
                     ->setParam('denyController', $this->getRequest()->setControllerName())
                     ->setParam('denyModule', $this->getRequest()->setModuleName())
                     ->setParam('denyParams', $this->getRequest()->setParams())
                     ->setParam('role', $this->getRole())
                     ->setParam('resource', $resource)
                     ->setParam('permission', $permission)
                     ->setActionName($this->_denyAction)
                     ->setControllerName($this->_denyController)
                     ->setModuleName($this->_denyModule)
                     ->setParams($this->_denyParams)
                     ->setDispatched(false);
            }
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
