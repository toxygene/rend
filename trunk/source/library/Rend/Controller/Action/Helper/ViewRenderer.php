<?php
/**
 *
 */

/** Zend_Controller_Action_Helper_ViewRenderer */
require_once 'Zend/Controller/Action/Helper/ViewRenderer.php';

/**
 *
 */
class Rend_Controller_Action_Helper_ViewRenderer extends Zend_Controller_Action_Helper_ViewRenderer
{

    /**
     * Retrieve front controller instance
     *
     * @return  Rend_Controller_Front
     */
    public function getFrontController()
    {
        if (null === $this->_frontController) {
            $this->_frontController = Rend_Controller_Front::getInstance();
        }

        return $this->_frontController;
    }

    /**
     *
     */
    public function initView($path = null, $prefix = null, array $options = array())
    {
        if (null === $this->view) {
            $this->setView($this->getFrontController()->getFactoryPluginLoader()->view);
        }

        parent::initView($path, $prefix, $options);
    }

}
