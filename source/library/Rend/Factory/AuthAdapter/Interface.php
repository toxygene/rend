<?php
/**
 *
 */

/**
 *
 */
interface Rend_Factory_AuthAdapter_Interface extends Rend_Factory_Interface
{

    /**
     * Create method for factory
     *
     * @return  Zend_Auth_Adapter_Interface
     */
    public function create();

}
