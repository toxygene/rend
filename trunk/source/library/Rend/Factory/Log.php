<?php
/**
 *
 */

/** Rend_Factory_Abstract */
require_once 'Rend/Factory/Abstract.php';

/** Zend_Log */
require_once 'Zend/Log.php'

/** Zend_Log_Writer_Null */
require_once 'Zend/Log/Writer/Null.php';

/**
 *
 */
class Rend_Factory_Log extends Rend_Factory_Abstract implements Rend_Factory_Log_Interface
{

    /**
     * Configuration file
     * @var     string
     */
    private $_configFile;

    /**
     * Get a log object
     *
     * @return  Zend_Log
     */
    public function create()
    {
        $log = new Zend_Log();

        include $this->_configFile;

        return $log;
    }

    /**
     * Set the config file
     *
     * @param   string  $configFile
     * @return  Rend_Factory_Log
     */
    public function setConfigFile($configFile)
    {
        $this->_configFile = $configFile;
        return $this;
    }

}
