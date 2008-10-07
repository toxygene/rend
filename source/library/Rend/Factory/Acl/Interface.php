<?php
/**
 *
 */

/**
 *
 */
interface Rend_Factory_Acl_Interface
{

    /**
     * Create method for factory
     *
     * @return  Zend_Acl
     */
    public function create();

    /**
     * Get the name of the factory
     *
     * @return  string
     */
    public function getName();

}
