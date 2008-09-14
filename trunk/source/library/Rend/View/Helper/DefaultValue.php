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
 * @package     View
 * @copyright   2008 Justin Hendrickson
 * @license     http://www.rendframework.com/license/new-bsd    New BSD License
 * @link        http://www.rendframework.com/
 * @since       1.0.0
 * @version     $Id$
 */

/**
 * Default helper
 *
 * The default helper is a direct port of Smarty's
 * {@link http://smarty.php.net/manual/en/language.modifier.default.php
 * default variable modifier}.
 *
 * @category    Rend
 * @package     View
 */
class Rend_View_Helper_DefaultValue
{

    /**
     * Load a value or it's default
     *
     * @param   mixed   $value
     * @param   mixed   $default
     * @return  mixed
     */
    public function defaultValue($value, $default)
    {
        if ($value) {
            return $value;
        }

        return $default;
    }

}
