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
 * Default helper
 *
 * The default helper is a port of Smarty's
 * {@link http://smarty.php.net/manual/en/language.modifier.default.php
 * default variable modifier}.
 *
 * @category Rend
 * @package View
 */
class Rend_View_Helper_DefaultValue extends Zend_View_Helper_Abstract
{

    /**
     * Load a value or it's default
     *
     * @param mixed $value
     * @param mixed $default
     * @return mixed
     */
    public function defaultValue($value, $default)
    {
        if ($value) {
            return $value;
        }

        return $default;
    }

    /**
     * Strategy method
     *
     * @see defaultValue()
     * @param mixed $value
     * @param mixed $default
     * @return mixed
     */
    public function direct($value = null, $default = null)
    {
        return $this->defaultValue($value, $default);
    }

}
