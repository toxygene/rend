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
     * Create an Auth adapter object
     *
     * @return Zend_Auth_Adapter_Interface
     */
    public function create();

}
