<?php
/**
 *
 */

/**
 *
 */
interface Rend_Factory_AclStorage_Interface
{

    /**
     * Create method for factory
     *
     * @return  Zend_Auth_Storage_Interface
     */
    public function create();

    /**
     * Get the name of the factory
     *
     * @return  string
     */
    public function getName();

}
