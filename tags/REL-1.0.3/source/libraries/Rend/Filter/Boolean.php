<?php
/**
 * Rend
 *
 * This source file is subject to the new BSD license that is bundled
 * with this package in the file LICENSE.txt.
 * It is also available through the world-wide-web at this URL:
 * http://rend.superglobals.com/license/new-bsd
 * If you did not receive a copy of the license and are unable to
 * obtain it through the world-wide-web, please send an email
 * to justin.hendrickson+rend@gmail.com so I can send you a copy immediately.
 *
 * @category    Rend
 * @package     Filter
 * @copyright   2008 Justin Hendrickson
 * @license     http://rend.superglobals.com/license/new-bsd    New BSD License
 * @link        http://rend.superglboals.com/
 * @since       1.0.0
 * @version     $Id$
 */

/** Zend_Filter_Interface */
require_once 'Zend/Filter/Interface.php';

/**
 * Boolean filter
 *
 * Filters a value to a boolean.
 *
 * @category    Rend
 * @package     Filter
 */
class Rend_Filter_Boolean implements Zend_Filter_Interface
{

    /**
     * Filter a value
     *
     * @param   mixed       $value
     * @return  boolean
     */
    public function filter($value)
    {
        return (boolean) $value;
    }

}
