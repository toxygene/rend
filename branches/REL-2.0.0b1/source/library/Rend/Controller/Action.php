<?php
/**
 *
 */

/** Zend_Controller_Action */
require_once "Zend/Controller/Action.php";

/**
 *
 */
abstract class Rend_Controller_Action extends Zend_Controller_Action
{

    /**
     * Get the config object
     *
     * @return 	Zend_Config
     */
    public function getConfig()
    {
        return $this->getInvokeArg("rendConfig");
    }

    /**
     * Get the factory loader
     *
     * @return  Rend_FactoryLoader
     */
    public function getFactoryLoader()
    {
        return $this->getInvokeArg("rendFactoryLoader");
    }

}
