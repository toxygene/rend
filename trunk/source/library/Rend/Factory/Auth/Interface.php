<?php
/**
 *
 */

/**
 *
 */
interface Rend_Factory_Auth_Interface extends Rend_Factory_Interface
{

    /**
     * Create method for factory
     *
     * @return  Zend_Auth
     */
    public function create();

}
