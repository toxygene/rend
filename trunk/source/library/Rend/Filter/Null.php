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
 * @package Filter
 * @copyright 2008-2009 Justin Hendrickson
 * @license http://www.rendframework.com/license.html    New BSD License
 * @link http://www.rendframework.com/
 * @since 1.0.0
 * @version $Id$
 */

/** Zend_Filter_Interface */
require_once "Zend/Filter/Interface.php";

/**
 * Null filter
 *
 * Filters a value to null if not present.
 *
 * @category Rend
 * @package Filter
 */
class Rend_Filter_Null implements Zend_Filter_Interface
{

    /**
     * Filter a value
     *
     * @param mixed $value
     * @return string
     */
    public function filter($value)
    {
        return $value ? $value : null;
    }

}
