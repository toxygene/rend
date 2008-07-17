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
class Rend_Factory_Log extends Rend_Factory_Abstract
{

    /**
     * Configuration file target
     * @var     string
     */
    private $_configTarget = ':rendConfigDir/:filename.:suffix';

    /**
     * Get a log object
     *
     * @return  Zend_Log
     */
    public function create()
    {
        $log = new Zend_Log();
        $log->addWriter(new Zend_Log_Writer_Null());

        $inflector = $this->getRendInflector()
                          ->setTarget($this->getConfigTarget());

        include $inflector->filter(array(
            'filename'  => 'log',
            'suffix'    => 'php'
        ));

        return $log;
    }

    /**
     * Get the config target
     *
     * @return  string
     */
    public function getConfigTarget()
    {
        return $this->_configTarget;
    }

    /**
     * Set the config target
     *
     * The following sources will be applied to the target when filtered:
     * * configPath: Path to the configuration directory
     * * filename: Filename for the log configuration file
     * * suffix: Suffix for the log configuration file
     *
     * @param   string  $configTarget
     * @return  Rend_Factory_Log
     */
    public function setConfigTarget($configTarget)
    {
        $this->_configTarget = $configTarget;
        return $this;
    }

}
