<?php
/**
 *
 */

/** Rend_Factory_Abstract */
require_once 'Rend/Factory/Abstract.php';

/** Rend_Factory_MailTransport_Interface */
require_once 'Rend/Factory/MailTransport/Interface.php';

/** Zend_Mail_Transport_Sendmail */
require_once 'Zend/Mail/Transport/Sendmail.php';

/**
 *
 */
class Rend_Factory_MailTransport_Sendmail extends Rend_Factory_Abstract implements Rend_Factory_MailTransport_Interface
{

    /**
     * @var     string
     */
    protected $_parameters;

    /**
     * Get a sendmail transport object
     *
     * @return  Zend_Mail_Transport_Sendmail
     */
    public function create()
    {
        return new Zend_Mail_Transport_Sendmail(
            $this->_parameters
        );
    }

    /**
     * Set the parameters
     *
     * @return  Rend_Factory_MailTransport_Sendmail
     */
    public function setParameters($parameters)
    {
        $this->setParameters($parameters);
        return $this;
    }

}
