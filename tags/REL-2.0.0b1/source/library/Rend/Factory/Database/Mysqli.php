<?php
/**
 *
 */

/** Rend_Factory_Database */
require_once "Rend/Factory/Database.php";

/** Zend_Db_Adapter_Mysqli */
require_once "Zend/Db/Adapter/Mysqli.php";


/**
 *
 */
class Rend_Factory_Database_Mysqli extends Rend_Factory_Database
{

    /**
     * Create a Mysqli adapter
     *
     * @return  Zend_Db_Adapter_Mysqli
     */
    public function create()
    {
        return new Zend_Db_Adapter_Mysqli($this->_params);
    }

}
