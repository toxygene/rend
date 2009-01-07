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
 * @package Controller
 * @copyright 2008 Justin Hendrickson
 * @license http://www.rendframework.com/license.html    New BSD License
 * @link http://www.rendframework.com/
 * @since 1.0.0
 * @version $Id$
 */

/** Rend_Controller_Action_Helper_Abstract */
require_once 'Rend/Controller/Action/Helper/Abstract.php';

/**
 * @category Rend
 * @package Controller
 */
class Rend_Controller_Action_Helper_IsAllowed extends Rend_Controller_Action_Helper_Abstract
{

    /**
     * All actions wildcard
     * @var string
     */
    const ALL_ACTIONS = "*";

    /**
     * Disable ACL wildcard
     * @var string
     */
    const DISABLE_ACL = "*";

    /**
     * Forbidden error code
     * @var integer
     */
    const FORBIDDEN = 401;

    /**
     * Unauthorized error code
     * @var integer
     */
    const UNAUTHORIZED = 403;

    /**
     * ACL object
     * @var Zend_Acl
     */
    private $_acl;

    /**
     * Forbidden action
     * @var string
     */
    private $_forbiddenAction = "forbidden";

    /**
     * Forbidden controller
     * @var string
     */
    private $_forbiddenController = "error";

    /**
     * Forbidden module
     * @var string
     */
    private $_forbiddenModule = "default";

    /**
     * Forbidden params
     * @var array
     */
    private $_forbiddenParams = array();

    /**
     * Role name
     * @var string
     */
    private $_role;

    /**
     * Throw exceptions flag
     * @var boolean
     */
    private $_throwExceptions = false;

    /**
     * Unauthorized action
     * @var string
     */
    private $_unauthorizedAction = "unauthorized";

    /**
     * Unauthorized controller
     * @var string
     */
    private $_unauthorizedController = "error";

    /**
     * Unauthorized module
     * @var string
     */
    private $_unauthorizedModule = "default";

    /**
     * Unauthorized params
     * @var array
     */
    private $_unauthorizedParams = array();

    /**
     * Check if the current role has permission to the resource
     *
     * @param string $resource
     * @param string $permission
     * @return boolean
     * @throws Zend_Controller_Action_Exception
     */
    public function isAllowed($resource, $permission = null)
    {
        return $this->_getAcl()
                    ->isAllowed($this->_role, $resource, $permission);
    }

    /**
     * Set the acl object
     *
     * @param Zend_Acl $acl
     * @return Rend_Controller_Action_Helper_IsAllowed
     */
    public function setAcl(Zend_Acl $acl)
    {
        $this->_acl = $acl;
        return $this;
    }

    /**
     * Set the forbidden page
     *
     * @param string $action
     * @param string $controller
     * @param string $module
     * @param array $params
     * @return Rend_Controller_Action_Helper_IsAllowed
     */
    public function setForbiddenPage($action, $controller = null, $module = null, $params = null)
    {
        $this->_forbiddenAction     = $action;
        $this->_forbiddenController = $controller;
        $this->_forbiddenModule     = $module;
        $this->_forbiddenParams     = $params;
        return $this;
    }

    /**
     * Set the role name
     *
     * @param string $role
     * @return Rend_Controller_Action_Helper_IsAllowed
     */
    public function setRole($role = null)
    {
        $this->_role = $role;
        return $this;
    }

    /**
     * Set the throw exceptions flag
     *
     * @param boolean $throwExceptions
     * @return Rend_Controller_Action_Helper_IsAllowed
     */
    public function setThrowExceptions($throwExceptions)
    {
        $this->_throwExceptions = (boolean) $throwExceptions;
        return $this;
    }

    /**
     * Set the unauthorized page
     *
     * @param string $action
     * @param string $controller
     * @param string $module
     * @param array $params
     * @return Rend_Controller_Action_Helper_IsAllowed
     */
    public function setUnauthorizedPage($action, $controller = null, $module = null, $params = null)
    {
        $this->_unauthorizedAction     = $action;
        $this->_unauthorizedController = $controller;
        $this->_unauthorizedModule     = $module;
        $this->_unauthorizedParams     = $params;
        return $this;
    }

    /**
     * Check the Acls for permission to the resource
     *
     * @throws Rend_Controller_Action_Exception_Acl
     * @throws Rend_Controller_Action_Exception_Auth
     * @throws Zend_Controller_Action_Exception
     */
    public function preDispatch()
    {
        list ($resource, $permission) = $this->_getRequiredResourceAndPermission();

        if (!$resource) {
            return;
        }

        if (!$this->isAllowed($resource, $permission)) {
            $perm = $permission ? $permission : "*default*";

            $this->getRequest()
                 ->setParam("deniedAction", $this->getRequest()->getActionName())
                 ->setParam("deniedController", $this->getRequest()->getControllerName())
                 ->setParam("deniedModule", $this->getRequest()->getModuleName())
                 ->setParam("deniedParams", $this->getRequest()->getParams())
                 ->setParam("deniedRole", $this->_role)
                 ->setParam("deniedResource", $resource)
                 ->setParam("deniedPermission", $perm)
                 ->setDispatched(false);

            if ($this->_throwExceptions) {
                throw new Zend_Controller_Action_Exception(
                	"Permission '{$perm}' denied on resource '{$resource}' for role '{$this->_role}'",
                    $permission ? self::UNAUTHORIZED : self::FORBIDDEN
                );
            } else {
                if (!$this->_role) {
                    $this->getRequest()
                         ->setActionName($this->_unauthorizedAction)
                         ->setControllerName($this->_unauthorizedController)
                         ->setModuleName($this->_unauthorizedModule)
                         ->setParams($this->_unauthorizedParams);
                } else {
                    $this->getRequest()
                         ->setActionName($this->_forbiddenAction)
                         ->setControllerName($this->_forbiddenController)
                         ->setModuleName($this->_forbiddenModule)
                         ->setParams($this->_forbiddenParams);
                }
            }
        }
    }

    /**
     * Get the ACL object
     *
     * @return Zend_Acl
     * @throws Zend_Controller_Action_Exception
     */
    protected function _getAcl()
    {
        if (!$this->_acl) {
            if (!$this->_getFactoryLoader() ||
                !isset($this->_getFactoryLoader()->acl) ||
                !$this->_getFactoryLoader()->acl instanceof Rend_Factory_Acl_Interface) {
                /** Zend_Controller_Action_Exception */
                require_once "Zend/Controller/Action/Exception.php";

                throw new Zend_Controller_Action_Exception("Could not load an ACL object");
            }

            $this->_acl = $this->_getFactoryLoader()
                               ->acl();
        }
        return $this->_acl;
    }

    /**
     * Format the Acl results consistently
     *
     * @param array $results
     * @return array
     */
    protected function _formatAclResults($results)
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

    /**
     * Determine the resource and permission required to access the requested
     * action
     *
     * @param string  $actionName
     * @return array
     * @todo Replace temporary variables with queries
     * @todo Decompose conditionals
     */
    private function _getRequiredResourceAndPermission()
    {
        $actionName       = $this->_getActionName();
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

}
