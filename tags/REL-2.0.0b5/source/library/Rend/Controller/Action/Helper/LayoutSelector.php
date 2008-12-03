<?php
/**
 * Rend
 *
 * LICENSE
 *
 * This source file is subject to the new BSD license that is bundled
 * with this package in the file LICENSE.txt.
 * It is also available through the world-wide-web at this URL:
 * http://www.rendframework.com/License
 * If you did not receive a copy of the license and are unable to
 * obtain it through the world-wide-web, please send an email
 * to justin.hendrickson+rend@gmail.com so I can send you a copy immediately.
 *
 * @category    Rend
 * @package     Controller
 * @copyright   Copyright (c) 2008 Justin Hendrickson (http://www.rendframework.com)
 * @license     http://www.rendframework.com/License New BSD License
 * @since       1.0.0
 * @version     $Id$
 */

/** Rend_Controller_Action_Helper_Abstract */
require_once 'Rend/Controller/Action/Helper/Abstract.php';

/**
 * @category    Rend
 * @package     Controller
 */
class Rend_Controller_Action_Helper_LayoutSelector extends Rend_Controller_Action_Helper_Abstract
{

    /**
     * Wildcard character
     * @var     string
     */
    const WILDCARD = "*";

    /**
     * Layout object
     * @var     Zend_Layout
     */
    protected $_layout;

    /**
     * Layout parameter
     * @var     string
     */
    protected $_parameter;

    /**
     * Set the layout object
     *
     * @param   Zend_Layout     $layout
     * @return  Rend_Controller_Action_Helper_LayoutSelector
     */
    public function setLayout(Zend_Layout $layout)
    {
        $this->_layout = $layout;
        return $this;
    }

    /**
     * Set the parameter name for the action controller
     *
     * @param   string  $parameter
     * @return  Rend_Controller_Action_Helper_LayoutSelector
     */
    public function setParameter($parameter)
    {
        $this->_parameter = $parameter;
        return $this;
    }

    /**
     * Set the layout based on the requested action
     */
    public function postDispatch()
    {
        if (!$this->_layout) {
            throw new Zend_Controller_Action_Exception("You must provide a layout object before use");
        }

        if ($this->getRequest()->isDispatched() && $this->_layout->isEnabled()) {
            $actionController = $this->getActionController();
            $actionName       = $this->_getActionName();
            $parameter        = $this->_parameter;

            if (isset($actionController->$parameter)) {
                if (isset($actionController->{$parameter}[$actionName])) {
                    $this->_setLayoutScript($actionController->{$parameter}[$actionName]);
                } elseif (isset($actionController->{$parameter}[self::WILDCARD])) {
                    $this->_setLayoutScript($actionController->{$parameter}[self::WILDCARD]);
                }
            }
        }
    }

    /**
     * Set the layout script
     *
     * @param   string  $script
     * @return  Rend_Controller_Action_Helper_LayoutSelector
     */
    private function _setLayoutScript($script)
    {
        $this->_layout
             ->setLayout($script);

        return $this;
    }

}
