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
    const WILDCARD = '*';

    /**
     * @var Zend_Layout
     */
    private $_layout;

    /**
     * Constructor
     *
     * @param   Zend_Layout     $layout
     */
    public function __construct(Zend_Layout $layout = null)
    {
        $this->_layout = $layout;
    }

    /**
     * Get the layout object
     *
     * @return Zend_Layout
     */
    public function getLayout()
    {
        if (!$this->_layout) {
             $this->_layout = $this->_getActionHelper('layout')
                                   ->getLayoutInstance();
        }
        return $this->_layout;
    }

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
     * Set the layout based on the requested action
     */
    public function postDispatch()
    {
        if ($this->getRequest()->isDispatched() && $this->getLayout()->isEnabled()) {
            $filePath = $this->_determineFilePath();
            if (!$filePath) {
                return;
            }

            if (is_array($layout)) {
                $file   = $layout[0];
                $module = $layout[1];
            } else {
                $file   = $layout;
                $module = $this->getRequest()->getModuleName();
            }

            $this->getLayout()
                 ->setLayout($file)
                 ->setLayoutPath($this->_getModuleDirectory($module) . '/views/scripts');
        }
    }

    /**
     *
     */
    private function _determineFilePath()
    {
        $actionController = $this->getActionController();
        $actionName       = $this->_getActionName();

        if (!isset($actionController->layouts)) {
            return;
        } elseif (isset($actionController->layouts[$actionName])) {
            return $actionController->layouts[$actionName];
        } elseif (isset($actionController->layouts[self::WILDCARD])) {
            return $actionController->layouts[self::WILDCARD];
        } else {
            return;
        }
    }

}
