<?php
/**
 *
 */

/** Rend_Controller_Action_Helper_Abstract */
require_once 'Rend/Controller/Action/Helper/Abstract.php';

/**
 *
 */
class Rend_Controller_Action_Helper_MailTransport extends Rend_Controller_Action_Helper_Abstract
{

    /**
     * Send an email
     *
     * @param   Zend_Mail
     */
    public function direct(Zend_Mail $mail)
    {
        return $this->_factory
                    ->mailTransport
                    ->send($mail);
    }

}
