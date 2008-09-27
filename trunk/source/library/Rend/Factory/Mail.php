<?php
/**
 *
 */

/** Rend_Factory_Abstract */
require_once 'Rend/Factory/Abstract.php';

/** Rend_Factory_Mail_Interface */
require_once 'Rend/Factory/Mail/Interface.php';

/** Zend_Mail */
require_once 'Zend/Mail.php';

/**
 *
 */
class Rend_Factory_Mail extends Rend_Factory_Abstract implements Rend_Factory_Mail_Interface
{

    /**
     *
     */
    protected $_charset;

    /**
     *
     */
    protected $_headers = array();

    /**
     * Create a new Zend_Mail object
     *
     * @return  Zend_Factory_Mail
     */
    public function create()
    {
        if ($this->_charset) {
            $mail = new Zend_Mail($this->_charset);
        } else {
            $mail = new Zend_Mail();
        }

        foreach ($this->_headers as $name => $value) {
            $mail->addHeader($name, $value);
        }

        return $mail;
    }

    /**
     *
     */
    public function setCharset($charset)
    {
        $this->_charset = $charset;
        return $this;
    }

    /**
     *
     */
    public function setHeaders(array $headers)
    {
        $this->_headers = $headers;
        return $this->_headers;
    }

}
