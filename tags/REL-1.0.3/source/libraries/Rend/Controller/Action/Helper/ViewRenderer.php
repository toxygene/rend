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
            $view = Zend_Controller_Action_HelperBroker::getStaticHelper('view')
                                                       ->direct();

            $this->setView($view);
        }

        parent::initView($path, $prefix, $options);

        $defaultModule = $this->getFrontController()
                              ->getDefaultModule();

        $path = $this->_getModuleViewDirectory($defaultModule);

        $this->view->addHelperPath("{$path}/helpers");
        $this->view->addFilterPath("{$path}/filters");
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
