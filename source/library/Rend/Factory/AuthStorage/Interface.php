<?php
/**
 *
 */

/**
 *
 */
interface Rend_Factory_AuthStorage_Interface extends Rend_Factory_Interface
{

    /**
     * Create method for factory
     *
     * @return  Zend_Auth_Storage_Interface
     */
    public function create();

}
