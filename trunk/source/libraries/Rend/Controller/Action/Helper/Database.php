<?php
/**
 *
 */

/** Rend_Controller_Action_Helper_Abstract */
require_once 'Rend/Controller/Action/Helper/Abstract.php';

/**
 *
 */
class Rend_Controller_Action_Helper_Database extends Rend_Controller_Action_Helper_Abstract
{

    /**
     * Configuration object
     * @var     Zend_Config
     */
    private $_config;

    /**
     * Database object
     * @var     Zend_Db_Adapter_Abstract
     */
    private $_database;

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
     * Get the database object
     *
     * @return  Zend_Db_Adapter_Abstract
     */
    public function direct()
    {
        return $this->getDatabase();
    }

    /**
     * Get the config object
     *
     * If no configuration object is present, it will try to load it from the
     * config action helper.
     *
     * @return  Zend_Config
     */
    public function getConfig()
    {
        if (!$this->_config) {
            $this->_config = $this->_getConfig()->database;
        }
        return $this->_config;
    }

    /**
     * Get the database object
     *
     * @return  Zend_Db_Adapter_Abstract
     */
    public function getDatabase()
    {
        if (!$this->_database) {
            if (!$this->getConfig() || !$this->getConfig()->valid()) {
                /** Zend_Controller_Action_Exception */
                require_once 'Zend/Controller/Action/Exception.php';
                throw new Zend_Controller_Action_Exception('Could not find database configuration information.');
            }

            /** Zend_Db */
            require_once 'Zend/Db.php';
            $this->_database = Zend_Db::factory($this->getConfig());
        }
        return $this->_database;
    }

    /**
     * Set the database object
     *
     * @param   Zend_Db_Adapter_Abstract    $database
     * @return  Rend_Controller_Action_Helper_Database
     */
    public function setDatabase(Zend_Db_Adapter_Abstract $database = null)
    {
        $this->_database = $database;
        return $this;
    }

}
