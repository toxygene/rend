<?php
/**
 * Rend
 *
 * LICENSE
 *
 * This source file is subject to the new BSD license that is bundled
 * with this package in the file LICENSE.txt.
 * It is also available through the world-wide-web at this URL:
 * http://rend.superglobals.com/License
 * If you did not receive a copy of the license and are unable to
 * obtain it through the world-wide-web, please send an email
 * to justin.hendrickson+rend@gmail.com so I can send you a copy immediately.
 *
 * @category    Rend
 * @package     Controller
 * @copyright   Copyright (c) 2008 Justin Hendrickson (http://rend.superglobals.com)
 * @license     http://rend.superglobals.com/License New BSD License
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
        $this->setLayout($layout);
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
    public function setLayout(Zend_Layout $layout = null)
    {
        $this->_layout = $layout;
        return $this;
    }

    /**
     * Set the layout based on the requested action
     */
    public function preDispatch()
    {
        if ($this->getLayout()->isEnabled()) {
            $actionController = $this->getActionController();
            $actionName       = $this->_getActionName();

            if (!isset ($actionController->layouts) || !isset($actionController->layouts[$actionName])) {
                return;
            }

            $layout = $actionController->layouts[$actionName];

            if (!is_array($layout)) {
                $layout = array($layout);
            }

            $this->getLayout()->setLayout($layout[0]);

            if (isset($layout[1])) {
                $this->getLayout()->setLayoutPath($this->_getModuleViewDirectory($layout[1]));
            }
        }
    }

    /**
     * Get the path to the views for a module
     *
     * @param   string  $module
     * @return  string
     */
    private function _getModuleViewDirectory($module)
    {
        $path = explode(
            DIRECTORY_SEPARATOR,
            $this->getFrontController()->getDispatcher()->getControllerDirectory($module)
        );

        array_pop($path);
        array_push($path, 'views');
        array_push($path, 'scripts');

        return implode(
            DIRECTORY_SEPARATOR,
            $path
        );
    }

}