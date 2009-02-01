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
 * @category Rend
 * @package Controller
 * @copyright Copyright (c) 2008 Justin Hendrickson (http://www.rendframework.com)
 * @license http://www.rendframework.com/License New BSD License
 * @since 1.0.0
 * @version $Id$
 */

/** Rend_Controller_Action_Helper_Abstract */
require_once 'Rend/Controller/Action/Helper/Abstract.php';

/**
 * @category Rend
 * @package Controller
 */
class Rend_Controller_Action_Helper_LayoutSelector extends Rend_Controller_Action_Helper_Abstract
{

    /**
     * Wildcard character
     * @var string
     */
    const WILDCARD = "*";

    /**
     * Layout object
     * @var Zend_Layout
     */
    protected $_layout;

    /**
     * Action layout parameter
     * @var string
     */
    protected $_actionLayoutKey = "layout";

    /**
     * Add an action layout
     *
     * @param string $action
     * @param string $layout
     * @return Rend_Controller_Action_Helper_LayoutSelector
     */
    public function addActionLayout($action, $layout)
    {
        $this->getActionController()->{$this->_actionLayoutKey}[$action] = $layout;
        return $this;
    }

    /**
     * Add action layouts
     *
     * @param array $actionLayouts
     * @return Rend_Controller_Action_Helper_LayoutSelector
     */
    public function addActionLayouts(array $actionLayouts)
    {
        foreach ($actionLayouts as $action => $layout) {
            $this->addActionLayout($action, $layout);
        }
        return $this;
    }

    /**
     * Clear the action layouts
     *
     * @return Rend_Controller_Action_Helper_LayoutSelector
     */
    public function clearActionLayouts()
    {
        $this->getActionController()->{$this->_actionLayoutKey} = array();
        return $this;
    }

    /**
     * Get an action layout
     *
     * @return string
     */
    public function getActionLayout($actionName)
    {
        if (!isset($this->getActionController()->{$this->_actionLayoutKey}[$actionName])) {
            return null;
        }

        return $this->getActionController()->{$this->_actionLayoutKey}[$actionName];
    }

    /**
     * Get the action layouts
     *
     * @return array
     */
    public function getActionLayouts()
    {
        if (!isset($this->getActionController()->{$this->_actionLayoutKey})) {
            return array();
        }

        return $this->getActionController()->{$this->_actionLayoutKey};
    }

    /**
     * Get the layout object
     *
     * @return Zend_Layout
     */
    public function getLayout()
    {
        if (!$this->_layout) {
            $layoutHelper = $this->getActionController()
                                 ->getHelper("layout");

            $this->_layout = $layoutHelper->getLayoutInstance();
        }

        return $this->_layout;
    }

    /**
     * Post-dispatch
     *
     * Once dispatching is complete, the layout script is set based on the last
     * action called.
     */
    public function postDispatch()
    {
        if ($this->getRequest()->isDispatched() && $this->getLayout()->isEnabled()) {
            $actionController = $this->getActionController();
            $actionName       = $this->_getCurrentActionName();

            if (isset($actionController->{$this->_actionLayoutKey})) {
                if (isset($actionController->{$this->_actionLayoutKey}[$actionName])) {
                    $this->_setLayoutScript($actionController->{$this->_actionLayoutKey}[$actionName]);
                } elseif (isset($actionController->{$this->_actionLayoutKey}[self::WILDCARD])) {
                    $this->_setLayoutScript($actionController->{$this->_actionLayoutKey}[self::WILDCARD]);
                }
            }
        }
    }

    /**
     * Set the layout object
     *
     * @param Zend_Layout $layout
     * @return Rend_Controller_Action_Helper_LayoutSelector
     */
    public function setLayout(Zend_Layout $layout)
    {
        $this->_layout = $layout;
        return $this;
    }

    /**
     * Set the action layout key for the action controller
     *
     * @param string $actionLayoutKey
     * @return Rend_Controller_Action_Helper_LayoutSelector
     */
    public function setActionLayoutKey($actionLayoutKey)
    {
        $this->_actionLayoutKey = $actionLayoutKey;
        return $this;
    }

    /**
     * Set the action layouts
     *
     * @param array $actionLayouts
     * @return Rend_Controller_Action_Helper_LayoutSelector
     */
    public function setActionLayouts(array $layouts)
    {
        return $this->clearActionLayouts()
                    ->addActionLayouts($layouts);
    }

    /**
     * Set the layout script
     *
     * @param string $script
     * @return Rend_Controller_Action_Helper_LayoutSelector
     */
    private function _setLayoutScript($script)
    {
        $this->getLayout()
             ->setLayout($script);

        return $this;
    }

}
