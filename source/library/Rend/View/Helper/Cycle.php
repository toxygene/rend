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
 * Cycle helper
 *
 * The cycle helper is a port of Smarty's
 * {@link http://smarty.php.net/manual/en/language.function.cycle.php cycle
 * custom function}. It allows for iteration over a set of values each time
 * it's called. The most common implementation is setting of odd/even rows in a
 * table.
 *
 * @category    Rend
 * @package     View
 */
class Rend_View_Helper_Cycle
{

    /**
     * Selections array
     * @var     array
     */
    static private $_selections = array();

    /**
     * Resets the selections
     */
    static public function resetCycles()
    {
        self::$_selections = array();
    }

    /**
     * Cycle helper
     *
     * Iterates over a set of selections.
     *
     * @param   array       $selections
     * @param   string      $name
     * @param   boolean     $switch
     * @return  string
     */
    public function cycle(array $selections, $name = 'default', $switch = true)
    {
        if (!isset(self::$_selections[$name])) {
            self::$_selections[$name] = $selections;
        }

        $selection = current(self::$_selections[$name]);

        if ($switch && (next(self::$_selections[$name]) === false)) {
            reset(self::$_selections[$name]);
        }

        return $selection;
    }

}
