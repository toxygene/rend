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
     * Create a mail transport object
     *
     * @return Zend_Mail_Transport_Abstract
     */
    public function create();

}
