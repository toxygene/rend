<?php
/**
 *
 */

/** Zend_Controller_Action_Helper_Abstract */
require_once 'Zend/Controller/Action/Helper/Abstract.php';

/**
 *
 */
class Rend_Controller_Action_Helper_Model extends Zend_Controller_Action_Helper_Abstract
{

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
            $database = $this->getActionController()
                             ->getFactory('database')
                             ->create();
        }

        /** Zend_Loader */
        require_once 'Zend/Loader.php';

        Zend_Loader::loadClass($name);

        return $name(array(
            Zend_Db_Table_Abstract::ADAPTER => $database
        ));
    }

}
