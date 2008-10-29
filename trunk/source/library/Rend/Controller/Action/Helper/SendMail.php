<?php
/**
 * Rend
 *
 * This source file is subject to the new BSD license that is bundled
 * with this package in the file LICENSE.txt.
 * It is also available through the world-wide-web at this URL:
 * http://www.rendframework.com/license.html
 * If you did not receive a copy of the license and are unable to
 * obtain it through the world-wide-web, please send an email
 * to justin.hendrickson+rend@gmail.com so I can send you a copy immediately.
 *
 * @category    Rend
 * @package     Controller
 * @copyright   2008 Justin Hendrickson
 * @license     http://www.rendframework.com/license.html    New BSD License
 * @link        http://www.rendframework.com/
 * @since       2.0.0
 * @version     $Id$
 */

/** Zend_Controller_Action_Helper_Abstract */
require_once 'Zend/Controller/Action/Helper/Abstract.php';

/**
 * Model loading helper
 *
 * @category    Rend
 * @package     Controller
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
            require_once "Zend/Controller/Action/Exception.php";
            throw new Zend_Controller_Action_Exception("You provide a transport object before use");
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
