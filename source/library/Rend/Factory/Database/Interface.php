<?php
/**
 *
 */

/** Rend_Factory_Interface */
require_once "Rend/Factory/Interface.php";

/**
 *
 */
interface Rend_Factory_Database_Interface extends Rend_Factory_Interface
{

    /**
     * Create a database adapter
     *
     * @return Zend_Db_Adapter_Abstract
     */
    public function create();

}
