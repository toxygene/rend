<?php
/**
 *
 */

/**
 *
 */
interface Rend_Factory_AuthStorage_Interface
{

    /**
     * Create an auth storage object
     *
     * @return Zend_Auth_Storage_Interface
     */
    public function create();

}
