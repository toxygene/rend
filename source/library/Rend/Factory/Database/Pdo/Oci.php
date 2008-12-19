<?php
/**
 *
 */

/** Rend_Factory_Database_Pdo_Abstract */
require_once "Rend/Factory/Database/Pdo/Abstract.php";

/**
 *
 */
class Rend_Factory_Database_Pdo_Oci extends Rend_Factory_Database_Pdo_Abstract
{

    /**
     * Create a Oracle Pdo adapter
     *
     * @return Zend_Db_Adapter_Pdo_Oci
     */
    public function create()
    {
        /** Zend_Db_Adapter_Pdo_Oci */
        require_once "Zend/Db/Adapter/Pdo/Oci.php";

        $database = new Zend_Db_Adapter_Pdo_Oci($this->_options);

        if ($this->_statementClass) {
            $database->setStatementClass($this->_statementClass);
        }

        return $database;
    }

    /**
     * Set the charset
     *
     * @param string $charset
     * @return Rend_Factory_Database_Pdo_Oci
     */
    public function setCharset($charset)
    {
        $this->_options["charset"] = $charset;
        return $this;
    }

}
