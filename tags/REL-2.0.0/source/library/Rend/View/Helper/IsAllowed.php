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
 * @package View
 * @copyright 2008-2009 Justin Hendrickson
 * @license http://www.rendframework.com/license.html    New BSD License
 * @link http://www.rendframework.com/
 * @since 1.0.0
 * @version $Id$
 */

/** Zend_View_Helper_Abstract */
require_once "Zend/View/Helper/Abstract.php";

/**
 * Acls rule checking helper
 *
 * @category Rend
 * @package View
 */
class Rend_View_Helper_IsAllowed extends Zend_View_Helper_Abstract
{

    /**
     * IsAllowed action helper
     * @var Rend_Controller_Action_Helper_IsAllowed
     */
    private $_isAllowedHelper;

    /**
     * Strategy method
     *
     * @see isAllowed()
     * @param string $resource
     * @param string $permission
     * @return boolean
     */
    public function direct($resource = null, $permission = null)
    {
        return $this->isAllowed($resource, $permission);
    }

    /**
     * Get the IsAllowed helper
     *
     * @return Rend_Controller_Action_Helper_IsAllowed
     * @throws Zend_Controller_Action_Exception
     */
    public function getIsAllowedHelper()
    {
        if (!$this->_isAllowedHelper) {
            /** Zend_Controller_Action_HelperBroker */
            require_once "Zend/Controller/Action/HelperBroker.php";

            $this->_isAllowedHelper = Zend_Controller_Action_HelperBroker::getExistingHelper("isAllowed");
        }

        return $this->_isAllowedHelper;
    }

    /**
     * Check the ACLs to see if the currently logged in user has permission to
     * access the requested resource
     *
     * @param string $resource
     * @param string $permission
     * @return boolean
     */
    public function isAllowed($resource, $permission = null)
    {
        return $this->getIsAllowedHelper()
                    ->isAllowed($resource, $permission);
    }

    /**
     * Set the IsAllowed helper
     *
     * @param Rend_Controller_Action_Helper_IsAllowed $isAllowedHelper
     * @return Rend_View_Helper_IsAllowed
     */
    public function setIsAllowedHelper(Rend_Controller_Action_Helper_IsAllowed $isAllowedHelper)
    {
        $this->_isAllowedHelper = $isAllowedHelper;
        return $this;
    }

}
