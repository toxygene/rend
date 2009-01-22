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
 * @license http://www.rendframework.com/license.html New BSD License
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
     * Wildcard string
     * @var string
     */
    const WILDCARD = "*";

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
    protected $_acl;

    /**
     * Forbidden action
     * @var string
     */
    protected $_forbiddenAction = "forbidden";

    /**
     * Forbidden controller
     * @var string
     */
    protected $_forbiddenController = "error";

    /**
     * Forbidden module
     * @var string
     */
    protected $_forbiddenModule = "default";

    /**
     * Forbidden parameters
     * @var array
     */
    protected $_forbiddenParameters = array();

    /**
     * Role name
     * @var string
     */
    protected $_role;

    /**
     * Context key
     * @var string
     */
    protected $_ruleKey = 'isAllowed';

    /**
     * Throw exceptions flag
     * @var boolean
     */
    protected $_throwExceptions = false;

    /**
     * Unauthorized action
     * @var string
     */
    protected $_unauthorizedAction = "unauthorized";

    /**
     * Unauthorized controller
     * @var string
     */
    protected $_unauthorizedController = "error";

    /**
     * Unauthorized module
     * @var string
     */
    protected $_unauthorizedModule = "default";

    /**
     * Unauthorized parameters
     * @var array
     */
    protected $_unauthorizedParameters = array();

    /**
     * Add a rule
     *
     * @param string $action
     * @param string $resource
     * @param string $permission
     * @return Rend_Controller_Action_Helper_IsAllowed
     */
    public function addRule($action, $resource, $permission = null)
    {
        $actionController = $this->getActionController();

        if (!isset($actionController->{$this->_ruleKey})) {
            $actionController->{$this->_ruleKey} = array();
        }

        if ($permission) {
            $actionController->{$this->_ruleKey}[$action] = array($resource, $permission);
        } else {
            $actionController->{$this->_ruleKey}[$action] = $resource;
        }

        return $this;
    }

    /**
     * Add rules
     *
     * @param array $rules
     * @return Rend_Controller_Action_Helper_IsAllowed
     */
    public function addRules(array $rules)
    {
        foreach ($rules as $key => $spec) {
            $action = null;
            if (!is_numeric($key)) {
                $action = $key;
            }

            if (is_array($spec)) {
                $resource   = null;
                $permission = null;
                if (isset($spec["action"])) {
                    $action   = $spec["action"];
                    $resource = $spec["resource"];
                    if (isset($spec["permission"])) {
                        $permission = $spec["permission"];
                    }
                    $this->addRule($action, $resource, $permission);
                } else {
                    $argc = count($spec);
                    switch ($argc) {
                        case 0:
                            continue;
                        case (1 <= $argc):
                            if (!$action) {
                                $action = array_shift($spec);
                            } else {
                                $resource = array_shift($spec);
                            }
                        case (2 <= $argc):
                            if (!$resource) {
                                $resource = array_shift($spec);
                            } else {
                                $permission = array_shift($spec);
                            }
                        case (3 <= $argc):
                            if (!$permission) {
                                $permission = array_shift($spec);
                            }
                        default:
                            $this->addRule($action, $resource, $permission);
                    }
                }
            } else {
                $this->addRule($action, $spec);
            }
        }

        return $this;
    }

    /**
     * Clear the rules
     *
     * @return Rend_Controller_Action_Helper_IsAllowed
     */
    public function clearRules()
    {
        $this->getActionController->{$this->_ruleKey} = array();

        return $this;
    }

    /**
     * Get a rule
     *
     * @param string $action
     * @return array
     */
    public function getRule($action)
    {
        $rules = $this->getRules();

        if (isset($rules[$action])) {
            // Bail out if this actions rule is disabled
            if ($rules[$action] == self::WILDCARD) {
                return;
            }

            return $this->_formatRuleResults($rules[$action]);
        } elseif (isset($rules[self::WILDCARD])) {
            // Bail out if all actions rules are disabled
            if ($rules[self::WILDCARD] == self::WILDCARD) {
                return;
            }

            return $this->_formatRuleResults($rules[self::WILDCARD]);
        }

       return;
    }

    /**
     * Get the rules
     *
     * @return array
     */
    public function getRules()
    {
        $actionController = $this->getActionController();

        if (isset($actionController->{$this->_ruleKey})) {
            return $actionController->{$this->_ruleKey};
        } else {
            return array();
        }
    }

    /**
     * Check if a rule exists
     *
     * @param string $action
     * @return boolean
     */
    public function hasRule($action)
    {
        $rules = $this->getRules();
        return isset($rules[$action]);
    }

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
     * Check the Acls for permission to the resource
     *
     * @throws Rend_Controller_Action_Exception_Acl
     * @throws Rend_Controller_Action_Exception_Auth
     * @throws Zend_Controller_Action_Exception
     */
    public function preDispatch()
    {
        list ($resource, $permission) = $this->getRule(
            $this->_getCurrentActionName()
        );

        if (!$resource) {
            return;
        }

        if (!$this->isAllowed($resource, $permission)) {
            $perm = $permission ? $permission : "*default*";

            $deniedParams = $this->getRequest()->getParams();
            unset($deniedParams[$this->getRequest()->getActionName()]);
            unset($deniedParams[$this->getRequest()->getControllerName()]);
            unset($deniedParams[$this->getRequest()->getModuleName()]);

            $this->getRequest()
                 ->setParam("deniedAction", $this->getRequest()->getActionName())
                 ->setParam("deniedController", $this->getRequest()->getControllerName())
                 ->setParam("deniedModule", $this->getRequest()->getModuleName())
                 ->setParam("deniedParams", $params)
                 ->setParam("deniedRole", $this->_role)
                 ->setParam("deniedResource", $resource)
                 ->setParam("deniedPermission", $perm);

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
                         ->setParams($this->_unauthorizedParameters)
                         ->setDispatched(false);
                } else {
                    $this->getRequest()
                         ->setActionName($this->_forbiddenAction)
                         ->setControllerName($this->_forbiddenController)
                         ->setModuleName($this->_forbiddenModule)
                         ->setParams($this->_forbiddenParameters)
                         ->setDispatched(false);
                }
            }
        }
    }

    /**
     * Remove a rule
     *
     * @param string $action
     * @return Rend_Controller_Action_Helper_IsAllowed
     */
    public function removeRule($action)
    {
        if ($this->hasRule($action)) {
            $actionController = $this->getActionController();
            unset($actionController->{$this->_ruleKey}[$action]);
        }

        return $this;
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
     * Set the forbidden action
     *
     * @param string $action
     * @return Rend_Controller_Action_Helper_IsAllowed
     */
    public function setForbiddenAction($action)
    {
        $this->_forbiddenAction = $action;
        return $this;
    }

    /**
     * Set the forbidden controller
     *
     * @param string $controller
     * @return Rend_Controller_Action_Helper_IsAllowed
     */
    public function setForbiddenController($controller)
    {
        $this->_forbiddenController = $controller;
        return $this;
    }

    /**
     * Set the forbidden module
     *
     * @param string $module
     * @return Rend_Controller_Action_Helper_IsAllowed
     */
    public function setForbiddenModule($module)
    {
        $this->_forbiddenModule = $module;
        return $this;
    }

    /**
     * Set the forbidden parameters
     *
     * @param array $parameters
     * @return Rend_Controller_Action_Helper_IsAllowed
     */
    public function setForbiddenParameters(array $parameters)
    {
        $this->_forbiddenParameters = $parameters;
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
     * Set the context key
     *
     * @param string $ruleKey
     * @return Rend_Controller_Action_Helper_IsAllowed
     */
    public function setRuleKey($ruleKey)
    {
        $this->_ruleKey = $ruleKey;
        return $this;
    }

    /**
     * Set the rules
     *
     * @param array $rules
     * @return Rend_Controller_Action_Helper_IsAllowed
     */
    public function setRules(array $rules)
    {
        return $this->clearRules()
                    ->addRules($rules);
    }

    /**
     * Set the throw exceptions flag
     *
     * @param boolean $throwExceptions
     * @return Rend_Controller_Action_Helper_IsAllowed
     */
    public function setThrowExceptions($throwExceptions)
    {
        $this->_throwExceptions = $throwExceptions;
        return $this;
    }

    /**
     * Set the unauthorized action
     *
     * @param string $action
     * @return Rend_Controller_Action_Helper_IsAllowed
     */
    public function setUnauthorizedAction($action)
    {
        $this->_unauthorizedAction = $action;
        return $this;
    }

    /**
     * Set the unauthorized controller
     *
     * @param string $controller
     * @return Rend_Controller_Action_Helper_IsAllowed
     */
    public function setUnauthorizedController($controller)
    {
        $this->_unauthorizedController = $controller;
        return $this;
    }

    /**
     * Set the unauthorized module
     *
     * @param string $module
     * @return Rend_Controller_Action_Helper_IsAllowed
     */
    public function setUnauthorizedModule($module)
    {
        $this->_unauthorizedModule = $module;
        return $this;
    }

    /**
     * Set the unauthorized parameters
     *
     * @param string $parameters
     * @return Rend_Controller_Action_Helper_IsAllowed
     */
    public function setUnauthorizedParameters(array $parameters)
    {
        $this->_unauthorizedParameters = $parameters;
        return $this;
    }

    /**
     * Format the rule results consistently
     *
     * @param array $results
     * @return array
     */
    protected function _formatRuleResults($results)
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
     * Get the ACL object
     *
     * @return Zend_Acl
     * @throws Zend_Controller_Action_Exception
     */
    protected function _getAcl()
    {
        if (!$this->_acl) {
            if (!$this->getFactoryLoader() ||
                !isset($this->getFactoryLoader()->acl) ||
                !$this->getFactoryLoader()->acl instanceof Rend_Factory_Acl_Interface) {
                /** Zend_Controller_Action_Exception */
                require_once "Zend/Controller/Action/Exception.php";

                throw new Zend_Controller_Action_Exception("Could not load an ACL object");
            }

            $this->_acl = $this->getFactoryLoader()
                               ->acl();
        }
        return $this->_acl;
    }

}
