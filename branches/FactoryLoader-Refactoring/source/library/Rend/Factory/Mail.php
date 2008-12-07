<?php
/**
 *
 */

/** Rend_FactoryLoader_Factory_Abstract */
require_once "Rend/FactoryLoader/Factory/Abstract.php";

/** Zend_Mail */
require_once "Zend/Mail.php";

/**
 *
 */
class Rend_Factory_Mail extends Rend_FactoryLoader_Factory_Abstract
{

    /**
     * Charset
     * @var string
     */
    protected $_charset;

    /**
     * From
     * @var array|string
     */
    protected $_from;

    /**
     * Headers
     * @var array
     */
    protected $_headers = array();

    /**
     * Create a new Zend_Mail object
     *
     * @return Zend_Factory_Mail
     */
    public function create()
    {
        if ($this->_charset) {
            $mail = new Zend_Mail($this->_charset);
        } else {
            $mail = new Zend_Mail();
        }

        if ($this->_from) {
            if (is_array($this->_from)) {
                $mail->setFrom($this->_from["email"], $this->_from["name"]);
            } else {
                $mail->setFrom($this->_from);
            }
        }

        foreach ($this->_headers as $name => $value) {
            $mail->addHeader($name, $value);
        }

        return $mail;
    }

    /**
     * Set the charset
     *
     * @param string $charset
     * @return Rend_Factory_Mail
     */
    public function setCharset($charset)
    {
        $this->_charset = $charset;
        return $this;
    }

    /**
     * Set the from address
     *
     * @param array|string $from
     * @return Rend_Factory_Mail
     */
    public function setFrom($from)
    {
        $this->_from = $from;
        return $this;
    }

    /**
     * Set the headers
     *
     * @param array $headers
     * @return Rend_Factory_Mail
     */
    public function setHeaders(array $headers)
    {
        $this->_headers = $headers;
        return $this->_headers;
    }

}
