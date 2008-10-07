<?php
/**
 *
 */

/**
 *
 */
interface Rend_Factory_Mail_Interface
{

    /**
     * Create method for factory
     *
     * @return  Zend_Mail
     */
    public function create();

    /**
     * Get the name of the factory
     *
     * @return  string
     */
    public function getName();

}
