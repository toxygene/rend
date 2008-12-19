<?php
/**
 *
 */

/** Rend_FactoryLoader_Factory_Abstract */
require_once "Rend/FactoryLoader/Factory/Abstract.php";

/** Zend_Log */
require_once "Zend/Log.php";

/**
 *
 */
class Rend_Factory_Log extends Rend_FactoryLoader_Factory_Abstract
{

    /**
     * Configuration file
     * @var string
     */
    private $_configFile = "../application/configs/log.php";

    /**
     * Create a log object
     *
     * @return Zend_Log
     */
    public function create()
    {
        if (!file_exists($this->_configFile)) {
            /** Rend_Factory_Log_Exception */
            require_once "Rend/Factory/Log/Exception.php";

            throw new Rend_Factory_Log_Exception("Could not load config file '{$this->_configFile}'");
        }

        $log = new Zend_Log();

        include $this->_configFile;

        return $log;
    }

    /**
     * Set the config file
     *
     * @param string $configFile
     * @return Rend_Factory_Log
     */
    public function setConfigFile($configFile)
    {
        $this->_configFile = $configFile;
        return $this;
    }

}
