<?php
/**
 *
 */

/**
 *
 */
interface Rend_Factory_AuthAdapter_Interface
{

    /**
     * Create method for factory
     *
     * @return  Zend_Auth_Adapter_Interface
     */
    public function create();

    /**
     * Get the name of the factory
     *
     * @return  string
     */
    public function getName();

}
