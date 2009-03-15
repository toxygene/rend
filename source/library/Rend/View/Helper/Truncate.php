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
 * @package View
 * @copyright 2008-2009 Justin Hendrickson
 * @license http://www.rendframework.com/license.html    New BSD License
 * @link http://www.rendframework.com/
 * @since 1.0.0
 * @version $Id$
 */

/** Zend_View_Helper_Abstract */
require_once "Zend/View/Helper/Abstract.php";

/**
 * @category Rend
 * @package View
 */
class Rend_View_Helper_Truncate extends Zend_View_Helper_Abstract
{

    /**
     * Iconv encoding
     * @var string
     */
    protected $_encoding;

    /**
     * Set the Iconv encoding
     *
     * @param string $encoding
     * @return Rend_View_Helper_Truncate
     * @throws Zend_View_Exception
     */
    public function setEncoding($encoding = null)
    {
        if ($encoding !== null) {
            $orig   = iconv_get_encoding('internal_encoding');
            $result = iconv_set_encoding('internal_encoding', $encoding);
            if (!$result) {
                /** Zend_View_Exception */
                require_once 'Zend/View/Exception.php';

                throw new Zend_View_Exception('Given encoding not supported on this OS!');
            }

            iconv_set_encoding('internal_encoding', $orig);
        }

        $this->_encoding = $encoding;
        return $this;
    }

    /**
     * Trucate a string
     *
     * Additional features include setting an ending string and attempting to
     * only truncate on word boundaries.
     *
     * @param string $string
     * @param integer $length
     * @param string $end
     * @param boolean $boundry
     * @return string
     * @throws InvalidArgumentException
     */
    public function truncate($string, $length, $end = '...', $boundry = false)
    {
        if ($length <= 0) {
            throw new InvalidArgumentException('Length must be greater than 0');
        }

        if (iconv_strlen($string, $this->_encoding) <= $length) {
            return $string;
        }

        if ($boundry) {
            $boundryLength = $length;
            while ($string[$boundryLength] != ' ' && $boundryLength > 0) {
                --$boundryLength;
            }

            if ($boundryLength != 0) {
                $length = $boundryLength;
            }
        }

        return iconv_substr($string, 0, $length, $this->_encoding) . $end;
    }

    /**
     * Strategy method
     *
     * @see truncate()
     * @param string $string
     * @param integer $length
     * @param string $end
     * @param boolean $boundry
     * @return string
     * @throws InvalidArgumentException
     */
    public function direct($string = null, $length = null, $end = '...', $boundry = false)
    {
        return $this->truncate($string, $length, $end, $boundry);
    }

}
