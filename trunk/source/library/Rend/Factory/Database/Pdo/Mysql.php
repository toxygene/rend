<?php
/**
 *
 */

/** Rend_Factory_Database_Pdo */
require_once "Rend/Factory/Database/Pdo.php";

/** Zend_Db_Adapter_Pdo_Mysql */
require_once "Zend/Db/Adapter/Pdo/Mysql.php";

/**
 *
 */
class Rend_Factory_Database_Pdo_Mysql extends Rend_Factory_Database_Pdo
{

    /**
     *
     * @return  Zend_Db_Adapter_Pdo_Mysql
     */
    public function create()
    {
        return new Zend_Db_Adapter_Pdo_Mysql($this->_params);
    }

}
