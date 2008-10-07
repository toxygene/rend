<?php
/**
 *
 */

/**
 *
 */
interface Rend_Factory_Auth_Interface
{

    /**
     * Create method for factory
     *
     * @return  Zend_Auth
     */
    public function create();

    /**
     * Get the name of the factory
     *
     * @return  string
     */
    public function getName();

}
