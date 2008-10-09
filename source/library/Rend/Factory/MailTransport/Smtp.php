<?php
/**
 *
 */

/** Rend_Factory_Abstract */
require_once 'Rend/Factory/Abstract.php';

/** Rend_Factory_MailTransport_Interface */
require_once 'Rend/Factory/MailTransport/Interface.php';

/** Zend_Mail_Transport_Smtp */
require_once 'Zend/Mail/Transport/Smtp.php';

/**
 *
 */
class Rend_Factory_MailTransport_Smtp extends Rend_Factory_Abstract implements Rend_Factory_MailTransport_Interface
{

    /**
     * @var     string
     */
    protected $_host;

    /**
     * @var     array
     */
    protected $_options;

    /**
     * Get a SMTP transport object
     *
     * @return  Zend_Mail_Transport_Smtp
     */
    public function create()
    {
        return new Zend_Mail_Transport_Smtp(
            $this->_host,
            $this->_options
        );
    }

    /**
     * Set the host name
     *
     * @param   string  $host
     * @return  Rend_Factory_MailTransport_Smtp
     */
    public function setHost($host)
    {
        $this->_host = $host;
        return $this;
    }

    /**
     * Set the options
     *
     * @param   array   $options
     * @return  Rend_Factory_MailTransport_Smtp
     */
    public function setOptions(array $options)
    {
        $this->_options = $options;
        return $this;
    }

}
