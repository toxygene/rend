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
 * @category    Rend
 * @package     Validate
 * @copyright   2008 Justin Hendrickson
 * @license     http://www.rendframework.com/license.html    New BSD License
 * @link        http://www.rendframework.com/
 * @since       1.0.0
 * @version     $Id$
 */

/** Zend_Validate_Abstract */
require_once 'Zend/Validate/Abstract.php';

/**
 * StringEquals validation
 *
 * Compares two supplied strings for equality
 *
 * @deprecated
 * @category    Rend
 * @package     Validate
 * @see         Rend_Validate_ConfirmField
 */
class Rend_Validate_StringEquals extends Zend_Validate_Abstract
{

    /**
     * Not equals message key
     * @var     string
     */
    const NOT_EQUALS = 'stringNotEquals';

    /**
     * Message templates
     * @var     array
     */
    protected $_messageTemplates = array(
        self::NOT_EQUALS => 'The values do not match.'
    );

    /**
     * Check if the values are equal
     *
     * @param   array       $value
     * @return  boolean
     */
    public function isValid($value)
    {
        $this->_setValue((string) $value);

        $initial = (string) current((array)$value);
        foreach ((array) $value as $element) {
            if ((string) $element != $initial) {
                $this->_error(self::NOT_EQUALS);
                return false;
            }
        }

        return true;
    }

}
