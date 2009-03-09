<?php
/**
 *
 */

/** Zend_Controller_Action_Helper_Abstract */
require_once "Zend/Controller/Action/Helper/Abstract.php";

class Rend_Controller_Action_Helper_FactoryLoader extends Zend_Controller_Action_Helper_Abstract
{

    /**
     * Factory loader
     * @var Rend_FactoryLoader
     */
    private $_factoryLoader;

    /**
     * Proxies to getFactoryLoader()
     *
     * @return Rend_FactoryLoader
     */
    public function direct()
    {
        return $this->getFactoryLoader();
    }

    /**
     * Get the factory loader
     *
     * @return Rend_FactoryLoader
     */
    public function getFactoryLoader()
    {
	return Zend_Controller_Front::getInstance()
                                    ->getParam("rendFactoryLoader");
    }

}
