<?php
/**
 *
 */

/** Rend_Controller_Action_Helper_Abstract */
require_once 'Rend/Controller/Action/Helper/Abstract.php';

/** Zend_Mail */
require_once 'Zend/Mail.php';

/**
 *
 */
class Rend_Controller_Action_Helper_Mail extends Rend_Controller_Action_Helper_Abstract
{

    /**
     * Default encoding
     * @var     string
     */
    const DEFAULT_ENCODING = 'UTF-8';

    /**
     * Encoding
     * @var     string
     */
    private $_encoding;

    /**
     * Constructor
     *
     * @param   string  $encoding
     */
    public function __construct($encoding = null)
    {
        $this->_encoding = $encoding;
    }

    /**
     * Get the mail object
     *
     * @return  Zend_Mail
     */
    public function direct()
    {
        return $this->getMail();
    }

    /**
     * Get the encoding
     *
     * @return  string
     */
    public function getEncoding()
    {
        if (!$this->_encoding) {
            $this->_encoding = $this->_getConfig()->encoding;
            if (!$this->_encoding) {
                $this->_encoding = self::DEFAULT_ENCODING;
            }
        }
        return $this->_encoding;
    }

    /**
     * Get a mail object
     *
     * @return  Zend_Mail
     */
    public function getMail()
    {
        return new Zend_Mail($this->getEncoding());
    }

}
