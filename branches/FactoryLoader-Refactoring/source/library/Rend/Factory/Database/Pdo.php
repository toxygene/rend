<?php
/**
 *
 */

/** Rend_Factory_Database_Abstract */
require_once "Rend/Factory/Database/Abstract.php";

/** Zend_Loader */
require_once "Zend/Loader.php";

/**
 *
 */
class Rend_Factory_Database_Pdo extends Rend_Factory_Database_Abstract
{

    /**
     * Create a Zend_Db Pdo adapter
     * @return Zend_Db_Adapter_Pdo_Abstract
     */
    public function create()
    {
        $className = "Zend_Db_Adapter_Pdo_" . ucFirst(strToLower($this->_driver));
        Zend_Loader::loadClass($className);
        return new $className($this->params);
    }

    /**
     *
     */
    public function setDriver($driver)
    {
        $this->_driver = $driver;
        return $this;
    }

}
