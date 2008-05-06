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

/** Zend_Controller_Action_HelperBroker */
require_once 'Zend/Controller/Action/HelperBroker.php';

/**
 * Extended helper abstract
 *
 * @category    Rend
 * @package     Controller
 */
abstract class Rend_Controller_Action_Helper_Abstract extends Zend_Controller_Action_Helper_Abstract
{

    /**
     * Retrieve front controller instance
     *
     * @return Rend_Controller_Front
     */
    public function getFrontController()
    {
        if (null === $this->_frontController) {
            /** Rend_Controller_Front */
            require_once 'Rend/Controller/Front.php';

            $this->_frontController = Rend_Controller_Front::getInstance();
        }

        return $this->_frontController;
    }

    /**
     * Get an action helper from the helper broker
     *
     * @param   string  $name
     * @return  Zend_Controller_Action_Helper_Abstract
     */
    protected function _getActionHelper($name)
    {
        return Zend_Controller_Action_HelperBroker::getStaticHelper($name);
    }

    /**
     * Get the formatted name of the requested action from the dispatcher
     *
     * Note: the 'Action' suffix is removed.
     *
     * @return  string
     */
    protected function _getActionName()
    {
        $action = $this->getRequest()->getActionName();
        if (empty($action)) {
            $action = $this->getFrontController()->getDispatcher()->getDefaultAction();
        }

        return substr($this->getFrontController()->getDispatcher()->formatActionName($action), 0, -6);
    }

    /**
     * Get the config object from the config helper
     *
     * @return  Zend_Config
     */
    protected function _getConfig()
    {
        return $this->_getActionHelper('config')->getConfig();
    }

}
