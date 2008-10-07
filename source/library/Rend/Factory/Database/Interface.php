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
     * Create method for factory
     *
     * @return  Zend_Db_Adapter_Abstract
     */
    public function create();

    /**
     * Get the name of the factory
     *
     * @return  string
     */
    public function getName();

}
