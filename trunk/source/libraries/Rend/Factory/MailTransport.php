<?php
/**
 *
 */

/** Rend_Factory_Abstract */
require_once 'Rend/Factory/Abstract.php';

/**
 *
 */
class Rend_Factory_MailTransport extends Rend_Factory_Abstract
{

    /**#@+
     * Adapter name
     * @var     string
     */
    const ADAPTER_SENDMAIL = 'sendmail';
    const ADAPTER_SMTP     = 'smtp';
    /**#@-*/

    /**
     * Get a mail transport object
     *
     * @return  Zend_Mail_Transport_Abstract
     */
    public function create()
    {
        switch ($this->_config->mail->transport->adapter) {
            case self::ADAPTER_SENDMAIL:
                /** Zend_Mail_Transport_Sendmail */
                require_once 'Zend/Mail/Transport/Sendmail.php';
                return new Zend_Mail_Transport_Sendmail(
                    $this->_config->mail->transport->options
                );
            break;

            case self::ADAPTER_SMTP:
                /** Zend_Mail_Transport_Smtp */
                require_once 'Zend/Mail/Transport/Smtp.php';
                return new Zend_Mail_Transport_Smtp(
                    $this->_config->mail->transport->host,
                    $this->_config->mail->transport->options->toArray()
                );
            break;

            default:
                /** Rend_Factory_Exception */
                require_once 'Rend/Factory/Exception.php';
                throw new Rend_Factory_Exception(
                    "Unknown mail transport type '{$this->_config->mail->transport->adapter}'"
                );
            break;
        }

        return $this->_transport;
    }

}
