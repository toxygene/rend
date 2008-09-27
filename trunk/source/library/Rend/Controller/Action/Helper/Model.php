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
     * Constructor
     *
     * @param   Zend_Db_Adapter_Abstract    $database
     */
    public function __construct(Zend_Db_Adapter_Abstract $database = null)
    {
        $this->_database = $database;
    }

    /**
     * Direct method
     *
     * Get a model by name
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
     * Get a model by name
     *
     * @param   string                      $name
     * @param   Zend_Db_Adapter_Abstract    $database
     * @return  Zend_Db_Table_Abstract
     */
    public function getModel($name, Zend_Db_Adapter_Abstract $database = null)
    {
        if (!$database) {
            $database = $this->_factory->database;
        }

        Zend_Loader::loadClass($name);

        return $name(array(
            Zend_Db_Table_Abstract::ADAPTER => $database
        ));
    }

}
