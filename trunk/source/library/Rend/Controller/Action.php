<?php
/**
 *
 */

/** Zend_Controller_Action */
require_once 'Zend/Controller/Action.php';

/**
 *
 */
class Rend_Controller_Action extends Zend_Controller_Action
{

    /**
     * Configuration
     * @var     Zend_Config
     */
    protected $_config;

    /**
     * Factory loader
     * @var     Rend_FactoryLoader
     */
    protected $_factory;

    /**
     * Initialize the controller
     */
    public function init()
    {
        parent::init();

        $this->_config = $this->getFrontController()
                              ->getParam('rendConfig');

        $this->_factory = $this->getFrontController()
                               ->getParam('rendFactoryLoader');
    }

    /**
     * Get a factory
     *
     * @param   string  $name
     * @return  Rend_Factory_Interface
     */
    public function getFactory($name)
    {
        return $this->_factory
                    ->getFactory($name);
    }

}
