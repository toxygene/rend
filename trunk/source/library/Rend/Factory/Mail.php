<?php
/**
 *
 */

/** Rend_Factory_Abstract */
require_once 'Rend/Factory/Abstract.php';

/** Zend_Mail */
require_once 'Zend/Mail.php';

/**
 *
 */
class Rend_Factory_Mail extends Rend_Factory_Abstract
{

    /**
     * Create a new Zend_Mail object
     *
     * @return  Zend_Factory_Mail
     */
    public function create()
    {
        if (isset($this->_config->mail->encoding)) {
            $mail = new Zend_Mail($this->_config->mail->encoding);
        } else {
            $mail = new Zend_Mail();
        }

        if (isset($this->_config->mail->from)) {
            if ($this->_config->mail->from instanceOf Zend_Config) {
                $mail->setFrom(
                    $this->_config->mail->from->email,
                    $this->_config->mail->from->name
                );
            } else {
                $mail->setFrom($this->_config->mail->from);
            }
        }

        if (isset($this->_config->mail->headers)) {
            foreach ($this->_config->mail->headers as $name => $value) {
                $mail->addHeader($name, $value, true);
            }
        }

        return $mail;
    }

}
