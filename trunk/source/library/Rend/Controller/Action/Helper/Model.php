<?php
/**
 *
 */

/** Rend_Controller_Action_Helper_Abstract */
require_once 'Rend/Controller/Action/Helper/Abstract.php';

/** Zend_Loader */
require_once 'Zend/Loader.php';

/**
 *
 */
class Rend_Controller_Action_Helper_Model extends Rend_Controller_Action_Helper_Abstract
{

    /**
     * Database object
     * @var     Zend_Db_Adapter_Abstract
     */
    private $_database;

    /**
     * Models
     * @var     array
     */
    private $_models = array();

    /**
     * Constructor
     *
     * @param   Zend_Db_Adapter_Abstract    $database
     */
    public function __construct(Zend_Db_Adapter_Abstract $database = null)
    {
        $this->_database = $database;
    }

    /**
     *
     */
    public function direct($name)
    {
        return $this->getModel($name);
    }

    /**
     * Get the database object
     *
     * @return  Zend_Db_Adapter_Abstract
     */
    public function getDatabase()
    {
        if (!$this->_database) {
            $this->_database = $this->_factory->database;
        }
        return $this->_database;
    }

    /**
     * Get a model
     *
     * @param   string  $name
     * @return  Zend_Db_Table_Abstract
     */
    public function getModel($name)
    {
        if (!isset($this->_models[$name])) {
            Zend_Loader::loadClass($name);
            $this->_models[$name] = new $name($this->getDatabase());
        }
        return $this->_models[$name];
    }

    /**
     * Set a model
     *
     * @param   string  $name
     * @param   mixed   $model
     * @return  Rend_Controller_Action_Helper_Model
     */
    public function setModel($name, $model)
    {
        $this->_models[$name] = $model;
        return $this;
    }

}
