<?php
/**
 *
 */

/** Rend_Factory_Interface */
require_once "Rend/Factory/Interface.php";

/**
 *
 */
interface Rend_Factory_MailTransport_Interface extends Rend_Factory_Interface
{

    /**
     * Create a mail transport object
     *
     * @return Zend_Mail_Transport_Abstract
     */
    public function create();

}
