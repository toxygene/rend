<?php
/**
 *
 */

/**
 *
 */
interface Rend_Factory_Database_Interface
{

    /**
     * Create a database adapter
     *
     * @return Zend_Db_Adapter_Abstract
     */
    public function create();

}
