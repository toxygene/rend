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
     * Config object
     * @var     Zend_Config
     */
    private $_config;

    /**
     * Transport object
     * @var     Zend_Mail_Transport_Abstract
     */
    private $_transport;

    /**
     * Constructor
     *
     * @param   Zend_Config     $config
     */
    public function __construct(Zend_Config $config = null)
    {
        $this->_config = $config;
    }

    /**
     * Get the mail transport object
     *
     * @return  Zend_Mail_Transport_Abstract
     */
    public function direct()
    {
        return $this->getMailTransport();
    }

    /**
     * Get the config object
     *
     * @return  string
     */
    public function getConfig()
    {
        if (!$this->_config) {
            $this->_config = $this->_getActionHelper('config')->mail->transport;
        }
        return $this->_config;
    }

    /**
     * Get a mail transport object
     *
     * @return  Zend_Mail_Transport_Abstract
     */
    public function getMailTransport()
    {
        switch ($this->getConfig()->adapter) {
            case 'sendmail':
                /** Zend_Mail_Transport_Sendmail */
                require_once 'Zend/Mail/Transport/Sendmail.php';
                $this->_transport = new Zend_Mail_Transport_Sendmail(
                    $this->getConfig()->options
                );
            break;

            case 'smtp':
                /** Zend_Mail_Transport_Smtp */
                require_once 'Zend/Mail/Transport/Smtp.php';
                $this->_transport = new Zend_Mail_Transport_Smtp(
                    $this->getConfig()->host,
                    $this->getConfig()->options->toArray()
                );
            break;
        }
        return $this->_transport;
    }

    /**
     * Set the mail transport object
     *
     * @param   Zend_Mail_Transport_Abstract
     * @return  Rend_Controller_Action_Helper_MailTransport
     */
    public function setMailTransport(Zend_Mail_Transport_Abstract $transport)
    {
        $this->_transport = $transport;
        return $this;
    }

}
