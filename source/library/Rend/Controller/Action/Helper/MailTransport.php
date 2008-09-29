<?php
/**
 *
 */

/** Zend_Controller_Action_Helper_Abstract */
require_once 'Zend/Controller/Action/Helper/Abstract.php';

/**
 *
 */
class Rend_Controller_Action_Helper_MailTransport extends Zend_Controller_Action_Helper_Abstract
{

    /**
     * Send an email
     *
     * @param   Zend_Mail   $mail
     * @return  unknown
     */
    public function direct(Zend_Mail $mail)
    {
        $mailTransport = $this->getActionController()
                              ->getFactory('mailTransport')
                              ->create();

        return $mail->send($mailTransport);
    }

}
