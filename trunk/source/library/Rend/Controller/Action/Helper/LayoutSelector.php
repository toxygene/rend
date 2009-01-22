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
     * Layout parameter
     * @var string
     */
    protected $_layoutKey = "layout";

    /**
     * Add a layout
     *
     * @param string $action
     * @param string $script
     * @return Rend_Controller_Action_Helper_LayoutSelector
     */
    public function addLayout($action, $script)
    {
        $this->getActionController()->{$this->_layoutKey}[$action] = $script;
        return $this;
    }

    /**
     * Add layouts
     *
     * @param array $layouts
     * @return Rend_Controller_Action_Helper_LayoutSelector
     */
    public function addLayouts(array $layouts)
    {
        foreach ($layouts as $layout) {
            $this->addLayout();
        }
        return $this;
    }

    /**
     * Clear the layouts
     *
     * @return Rend_Controller_Action_Helper_LayoutSelector
     */
    public function clearLayouts()
    {
        $this->getActionController()->{$this->_layoutKey} = array();
        return $this;
    }

    /**
     * Post-dispatch
     *
     * Once dispatching is complete, the layout script is set based on the last
     * action called.
     */
    public function postDispatch()
    {
        if ($this->getRequest()->isDispatched() && $this->_getLayout()->isEnabled()) {
            $actionController = $this->getActionController();
            $actionName       = $this->_getCurrentActionName();

            if (isset($actionController->{$this->_layoutKey})) {
                if (isset($actionController->{$this->_layoutKey}[$actionName])) {
                    $this->_setLayoutScript($actionController->{$this->_layoutKey}[$actionName]);
                } elseif (isset($actionController->{$this->_layoutKey}[self::WILDCARD])) {
                    $this->_setLayoutScript($actionController->{$this->_layoutKey}[self::WILDCARD]);
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
     * Set the layout key for the action controller
     *
     * @param string $layoutKey
     * @return Rend_Controller_Action_Helper_LayoutSelector
     */
    public function setLayoutKey($layoutKey)
    {
        $this->_layoutKey = $layoutKey;
        return $this;
    }

    /**
     * Set the layouts
     *
     * @param array $layouts
     * @return Rend_COntroller_Action_Helper_LayoutSelector
     */
    public function setLayouts(array $layouts)
    {
        return $this->clearLayouts()
                    ->addLayouts($layouts);
    }

    /**
     * Get the layout
     *
     * @return Zend_Layout
     */
    private function _getLayout()
    {
        if (!$this->_layout) {
            $layoutHelper = $this->getActionController()
                                 ->getHelper("layout");

            if (!$layoutHelper) {
                /** Zend_Controller_Action_Exception */
                require_once "Zend/Controller/Action/Exception.php";

                throw new Zend_Controller_Action_Exception("Could not load a layout object");
            }

            $this->_layout = $layoutHelper->getLayoutInstance();
        }

        return $this->_layout;
    }

    /**
     * Set the layout script
     *
     * @param string $script
     * @return Rend_Controller_Action_Helper_LayoutSelector
     */
    private function _setLayoutScript($script)
    {
        $this->_layout
             ->setLayout($script);

        return $this;
    }

}
