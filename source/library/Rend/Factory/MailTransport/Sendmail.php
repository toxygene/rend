<?php
/**
 *
 */

/** Rend_FactoryLoader_Factory_Abstract */
require_once "Rend/FactoryLoader/Factory/Abstract.php";

/** Rend_Factory_MailTransport_Interface */
require_once "Rend/Factory/MailTransport/Interface.php";

/**
 *
 */
class Rend_Factory_MailTransport_Sendmail extends Rend_FactoryLoader_Factory_Abstract implements Rend_Factory_MailTransport_Interface
{

    /**
     * Parameters
     * @var string
     */
    protected $_parameters;

    /**
     * Get a sendmail transport object
     *
     * @return Zend_Mail_Transport_Sendmail
     */
    public function create()
    {
        /** Zend_Mail_Transport_Sendmail */
        require_once "Zend/Mail/Transport/Sendmail.php";

        return new Zend_Mail_Transport_Sendmail(
            $this->_parameters
        );
    }

    /**
     * Set the parameters
     *
     * @return Rend_Factory_MailTransport_Sendmail
     */
    public function setParameters($parameters)
    {
        $this->setParameters($parameters);
        return $this;
    }

}
