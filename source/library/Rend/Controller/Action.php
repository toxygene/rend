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
     * Factory
     * @var     Rend_Factory
     */
    protected $_factory;

    /**
     * Initialize the controller
     */
    public function init()
    {
        parent::init();

        $this->_config = $this->getFrontController()
                              ->getConfig();

        $this->_factory = $this->getFrontController()
                               ->getFactoryLoader();
    }

}
