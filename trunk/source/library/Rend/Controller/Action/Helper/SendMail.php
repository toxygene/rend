<?php
/**
 *
 */

/** Zend_Controller_Action_Helper_Abstract */
require_once 'Zend/Controller/Action/Helper/Abstract.php';

/**
 *
 */
class Rend_Controller_Action_Helper_SendMail extends Zend_Controller_Action_Helper_Abstract
{

    /**
     * Zend_Mail_Transport_Abstract object
     * @var     Zend_Mail_Transport_Abstract
     */
    protected $_transport;

    /**
     * Send an email
     *
     * @param   Zend_Mail   $mail
     * @return  Zend_Mail
     */
    public function direct(Zend_Mail $mail)
    {
        if (!$this->_transport) {
            /** Zend_Controller_Action_Exception */
            require_once 'Zend/Controller/Action/Exception.php';
            throw new Zend_Controller_Action_Exception('You provide a transport object before use');
        }

        return $mail->send($this->_transport);
    }

    /**
     * Set the transport object
     *
     * @param   Zend_Mail_Transport_Abstract    $transport
     * @return  Rend_Controller_Action_Helper_SendMail
     */
    public function setTransport(Zend_Mail_Transport_Abstract $transport)
    {
        $this->_transport = $transport;
        return $this;
    }

}
