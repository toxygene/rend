<?php
/**
 *
 */

/** Zend_Controller_Action_Helper_Abstract */
require_once "Zend/Controller/Action/Helper/Abstract.php";

/**
 *
 */
class Rend_Controller_Action_Helper_Config extends Zend_Controller_Action_Helper_Abstract
{

    /**
     * Config object
     * @var Zend_Config
     */
    private $_config;

    /**
     * Proxies to getConfig()
     *
     * @return Zend_Config
     */
    public function direct()
    {
        return $this->getConfig();
    }

    /**
     * Get the config
     *
     * @return Zend_Config
     */
    public function getConfig()
    {
        if (!$this->_config) {
            $this->_config = Zend_Controller_Front::getInstance()
                                                  ->getParam("rendConfig");
        }

        return $this->_config;
    }

    /**
     * Set the config
     *
     * @param Zend_Config $config
     * @return Rend_Controller_Action_Helper_Config
     */
    public function setConfig(Zend_Config $config)
    {
        $this->_config = $config;
        return $this;
    }

}