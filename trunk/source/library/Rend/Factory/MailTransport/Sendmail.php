<?php
/**
 *
 */

/** Rend_FactoryLoader_Factory_Loader_Abstract */
require_once "Rend/FactoryLoader/Factory/Loader/Abstract.php";

/** Zend_Mail_Transport_Sendmail */
require_once "Zend/Mail/Transport/Sendmail.php";

/**
 *
 */
class Rend_Factory_MailTransport_Sendmail extends Rend_FactoryLoader_Factory_Loader_Abstract
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
