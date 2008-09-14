<?php
/**
 * Rend
 *
 * This source file is subject to the new BSD license that is bundled
 * with this package in the file LICENSE.txt.
 * It is also available through the world-wide-web at this URL:
 * http://www.rendframework.com/license/new-bsd
 * If you did not receive a copy of the license and are unable to
 * obtain it through the world-wide-web, please send an email
 * to justin.hendrickson+rend@gmail.com so I can send you a copy immediately.
 *
 * @category    Rend
 * @package     Validate
 * @copyright   2008 Justin Hendrickson
 * @license     http://www.rendframework.com/license/new-bsd    New BSD License
 * @link        http://www.rendframework.com/
 * @since       1.0.4
 * @version     $Id$
 */

/** Zend_Validate_Abstract */
require_once 'Zend/Validate/Abstract.php';

/**
 * ConfirmField validation
 *
 * Compares the current field's value with a different supplied field
 *
 * @category    Rend
 * @package     Validate
 */
class Rend_Validate_ConfirmField extends Zend_Validate_Abstract
{

    /**#@+
     * Errors
     * @var     string
     */
    const NOT_MATCH = 'notMatch';
    /**#@-*/

    /**
     * Error templates
     * @var array
     */
    protected $_messageTemplates = array(
        self::NOT_MATCH => "This value does not match the '%field%' field"
    );

    /**
     * Field to match against
     *
     * @var string
     */
    protected $_field;

    /**
     * Constructor
     *
     * @param   string  $field
     */
    public function __construct($field = null)
    {
        $this->_field = $field;
    }

    /**
     * Returns the field option
     *
     * @return string
     */
    public function getField()
    {
        return $this->_field;
    }

    /**
     * Sets the field option
     *
     * @param  string $field
     * @return Rend_Validate_ConfirmField
     */
    public function setField($field)
    {
        $this->_field = $field;
        return $this;
    }

    /**
     * Confirms the value matches another field
     *
     * @param  string $value
     * @throws Zend_Validate_Exception if there is a fatal error in field matching
     * @return boolean
     */
    public function isValid($value, $context = null)
    {
        $this->_setValue($value);

        if (is_array($context)) {
            if (isset($context[$this->_field])
                && ($value == $context[$this->_field]))
            {
                return true;
            }
        } elseif (is_string($context) && ($value == $context)) {
            return true;
        }

        $this->_error(self::NOT_MATCH);
        return false;
    }

}
