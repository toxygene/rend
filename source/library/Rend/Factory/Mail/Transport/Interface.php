<?php
/**
 *
 */

/**
 *
 */
interface Rend_Factory_MailTransport_Interface extends Rend_Factory_Interface
{

    /**
     * Create method for factory
     *
     * @return  Zend_Mail_Transport_Abstract
     */
    public function create();

}
