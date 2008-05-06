<?php
/**
 *
 */

/** Rend_Controller_Action_Helper_Abstract */
require_once 'Rend/Controller/Action/Helper/Abstract.php';

/**
 *
 */
class Rend_Controller_Action_Helper_Config extends Rend_Controller_Action_Helper_Abstract
{

    /**#@+
     * Modes
     * @var string
     */
    const PRODUCTION  = 'production';
    const DEVELOPMENT = 'development';
    const TESTING     = 'testing';
    /**#@-*/

    /**
     * Config object
     * @var     Zend_Config
     */
    private $_config;

    /**
     * Config filename
     * @var     string
     */
    private $_filename;

    /**
     * Config mode
     * @var     string
     */
    private $_mode;

    /**
     * Constructor
     *
     * @param   string  $filename
     * @param   string  $mode
     */
    public function __construct($filename = null, $mode = null)
    {
        $this->_filename = $filename;
        $this->_mode     = $mode;
    }

    /**
     * Get the config object
     *
     * @return  Zend_Config
     */
    public function direct()
    {
        return $this->getConfig();
    }

    /**
     * Get the config object
     *
     * @return  Zend_Config
     */
    public function getConfig()
    {
        if (!$this->_config) {
            /** Zend_Config_Ini */
            require_once 'Zend/Config/Ini.php';
            $this->_config = new Zend_Config_Ini(
                $this->getFilename(),
                $this->getMode()
            );
        }
        return $this->_config;
    }

    /**
     * Set the config object
     *
     * @param   Zend_Config $config
     * @return  Rend_Controller_Action_Helper_Config
     */
    public function setConfig(Zend_Config $config)
    {
        $this->_config = $config;
        return $this;
    }

    /**
     * Get the config filename
     *
     * @return  string
     */
    public function getFilename()
    {
        if (!$this->_filename) {
            $path = $this->getFrontController()->getParam('rendPath');
            if (!$path) {
                $path = '..';
            }
            $this->_filename = $path . '/config/config.ini';
        }
        return $this->_filename;
    }

    /**
     * Get the config mode
     *
     * @return  string
     */
    public function getMode()
    {
        if (!$this->_mode) {
            $this->_mode = $this->getFrontController()->getParam('rendMode');
            if (!$this->_mode) {
                $this->_mode = self::PRODUCTION;
            }
        }
        return $this->_mode;
    }

}
