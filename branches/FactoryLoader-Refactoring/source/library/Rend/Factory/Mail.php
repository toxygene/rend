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
     * Date
     * @var Zend_Date|integer|string
     */
    protected $_date;

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
     * Return path
     * @var string
     */
    protected $_returnPath;

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

        if ($this->_date) {
            $mail->setDate($this->_date);
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

        if ($this->_returnPath) {
            $mail->setReturnPath($this->_returnPath);
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
     * Set the date
     *
     * @param Zend_Date|integer|string $date
     * @return Rend_Factory_Mail
     */
    public function setDate($date)
    {
        $this->_date = $date;
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
        return $this;
    }

    /**
     * Set the return path
     *
     * @param string $returnPath
     * @return Rend_Factory_Mail
     */
    public function setReturnPath($returnPath)
    {
        $this->_returnPath = $returnPath;
        return $this;
    }

}
