<?php
/**
 * Rend
 *
 * This source file is subject to the new BSD license that is bundled
 * with this package in the file LICENSE.txt.
 * It is also available through the world-wide-web at this URL:
 * http://www.rendframework.com/license.html
 * If you did not receive a copy of the license and are unable to
 * obtain it through the world-wide-web, please send an email
 * to justin.hendrickson+rend@gmail.com so I can send you a copy immediately.
 *
 * @category Rend
 * @package Factory
 * @copyright 2008-2009 Justin Hendrickson
 * @license http://www.rendframework.com/license.html New BSD License
 * @link http://www.rendframework.com/
 * @since 2.0.0
 * @version $Id$
 */

/** Rend_Base_Abstract */
require_once "Rend/Base/Abstract.php";

/** Rend_Factory_Mail_Interface */
require_once "Rend/Factory/Mail/Interface.php";

/**
 * @category Rend
 * @package Factory
 */
class Rend_Factory_Mail extends Rend_Base_Abstract implements Rend_Factory_Mail_Interface
{

    /**
     * BCCs
     * @var array
     */
    protected $_bccs;

    /**
     * CCs
     * @var array
     */
    protected $_ccs;

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
     * Subject
     * @var string
     */
    protected $_subject;

    /**
     * Tos
     * @var array
     */
    protected $_tos;

    /**
     * Create a new Zend_Mail object
     *
     * @return Zend_Factory_Mail
     */
    public function create()
    {
        /** Zend_Mail */
        require_once "Zend/Mail.php";

        if ($this->_charset) {
            $mail = new Zend_Mail($this->_charset);
        } else {
            $mail = new Zend_Mail();
        }

        if ($this->_bccs) {
            foreach ($this->_bccs as $bcc) {
                $mail->addBcc($bcc);
            }
        }

        if ($this->_ccs) {
            foreach ($this->_ccs as $cc) {
                if (is_array($cc)) {
                    $mail->addCc($cc["email"], $cc["name"]);
                } else {
                    $mail->addCc($cc);
                }
            }
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

        if ($this->_subject) {
            $mail->setSubject($this->_subject);
        }

        if ($this->_tos) {
            foreach ($this->_tos as $to) {
                if (is_array($to)) {
                    $mail->addTo($to["email"], $to["name"]);
                } else {
                    $mail->addTo($to);
                }
            }
        }

        return $mail;
    }

    /**
     * Set the CCs
     *
     * @param array $ccs
     * @return Rend_Factory_Mail
     */
    public function setCcs(array $ccs)
    {
        $this->_ccs = $ccs;
        return $this;
    }

    /**
     * Set the BCCs
     *
     * @param array $bccs
     * @return Rend_Factory_Mail
     */
    public function setBccs(array $bccs)
    {
        $this->_bccs = $bccs;
        return $this;
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

    /**
     * Set the subject
     *
     * @param string $subject
     * @return Rend_Factory_Mail
     */
    public function setSubject($subject)
    {
        $this->_subject = $subject;
        return $this;
    }

    /**
     * Set the tos
     *
     * @param array $tos
     * @return Rend_Factory_Mail
     */
    public function setTos(array $tos)
    {
        $this->_tos = $tos;
        return $this;
    }

}
