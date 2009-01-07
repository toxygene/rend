<?php
/**
 *
 */

/** Rend_FactoryLoader_Factory_Abstract */
require_once "Rend/FactoryLoader/Factory/Abstract.php";

/** Rend_Factory_Log_Interface */
require_once "Rend/Factory/Log/Interface.php";

/**
 *
 */
class Rend_Factory_Log extends Rend_FactoryLoader_Factory_Abstract implements Rend_Factory_Log_Interface
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

        /** Zend_Log */
        require_once "Zend/Log.php";

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
