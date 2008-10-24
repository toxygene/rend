<?php
/**
 *
 */

/** Zend_Controller_Action_Helper_Abstract */
require_once 'Zend/Controller/Action/Helper/Abstract.php';

/**
 *
 */
class Rend_Controller_Action_Helper_LoadModel extends Zend_Controller_Action_Helper_Abstract
{

    /**
     * Database object
     * @var     Zend_Db_Table_Abstract
     */
    protected $_database;

    /**
     * Direct method
     *
     * Load a model by name
     *
     * @param   string                      $name
     * @param   Zend_Db_Adapter_Abstract    $database
     * @return  Zend_Db_Table_Abstract
     */
    public function direct($name, Zend_Db_Adapter_Abstract $database = null)
    {
        return $this->getModel($name, $database);
    }

    /**
     * Load a model by name
     *
     * @param   string                      $name
     * @param   Zend_Db_Adapter_Abstract    $database
     * @return  Zend_Db_Table_Abstract
     */
    public function getModel($name, Zend_Db_Adapter_Abstract $database = null)
    {
        if (!$database) {
            $database = $this->_database;
        }

        if (!$database) {
            /** Zend_Controller_Action_Exception */
            require_once 'Zend/Controller/Action/Exception.php';
            throw new Zend_Controller_Action_Exception('You provide a database object before use');
        }

        // TODO determine loader directories

        /** Zend_Loader */
        require_once 'Zend/Loader.php';

        Zend_Loader::loadClass($name);

        return $name(array(
            Zend_Db_Table_Abstract::ADAPTER => $database
        ));
    }

    /**
     * Set the database object
     *
     * @param   Zend_Db_Table_Abstract  $database
     * @return  Rend_Controller_Action_Helper_LoadModel
     */
    public function setDatabase(Zend_Db_Adapter_Abstract $database)
    {
        $this->_database = $database;
        return $this;
    }

}
