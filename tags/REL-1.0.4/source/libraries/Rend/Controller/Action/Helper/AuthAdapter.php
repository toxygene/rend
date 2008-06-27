<?php
/**
 *
 */

/** Zend_Controller_Action_Helper_Abstract */
require_once 'Zend/Controller/Action/Helper/Abstract.php';

/**
 *
 */
class Rend_Controller_Action_Helper_AuthAdapter extends Zend_Controller_Action_Helper_Abstract
{

    /**
     * Auth adapter object
     * @var     Zend_Auth_Adapter_Interface
     */
    private $_adapter;

    /**
     * Config object
     * @var     Zend_Config
     */
    private $_config;

    /**
     * Constructor
     *
     * @param   Zend_Config     $config
     */
    public function __construct(Zend_Config $config = null)
    {
        $this->_config = $config;
    }

    /**
     * Get the auth adapter object
     *
     * @return  Zend_Auth_Adapter_Interface
     */
    public function direct()
    {
        return $this->getAuthAdapter();
    }

    /**
     * Get the auth adapter object
     *
     * @return  Zend_Auth_Adapter_Interface
     */
    public function getAuthAdapter()
    {
        if (!$this->_adapter) {
            switch ($this->getConfig()->adapter) {
                case 'DbTable':
                break;
            }
        }
        return $this->_adapter;
    }

    /**
     * Set the auth transport object
     *
     * @param   Zend_Auth_Adapter_Interface     $adapter
     * @return  Rend_Controller_Action_Helper_AuthAdapter
     */
    public function setAuthAdapter(Zend_Auth_Adapter_Interface $adapter)
    {
        $this->_adapter = $adapter;
        return $this;
    }

    /**
     * Get the config object
     *
     * @return  Zend_Config
     */
    public function getConfig()
    {
        if (!$this->_config) {
            $this->_config = $this->_getActionHelper('config')->auth->adapter;
        }
        return $this->_config;
    }

}
