<?php
/**
 *
 */

/**
 *
 */
interface Rend_Factory_MailTransport_Interface
{

    /**
     * Create method for factory
     *
     * @return  Zend_Mail_Transport_Abstract
     */
    public function create();

    /**
     * Get the name of the factory
     *
     * @return  string
     */
    public function getName();

}
