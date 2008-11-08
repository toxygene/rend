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
 * @package     View
 * @copyright   2008 Justin Hendrickson
 * @license     http://www.rendframework.com/license.html    New BSD License
 * @link        http://www.rendframework.com/
 * @since       1.0.0
 * @version     $Id$
 */

/** Zend_View_Helper_Abstract */
require_once "Zend/View/Helper/Abstract.php";

/** Rend_View_Helper_Cycle_Container */
require_once 'Rend/View/Helper/Cycle/Container.php';

/**
 * Cycle helper
 *
 * The cycle helper is a port of Smarty's
 * {@link http://smarty.php.net/manual/en/language.function.cycle.php cycle
 * custom function}. It allows for iteration over a set of values each time
 * it's called. The most common implementation is zebra striping of rows.
 *
 * @category    Rend
 * @package     View
 */
class Rend_View_Helper_Cycle extends Zend_View_Helper_Abstract
{

    /**
     * Cycle helper
     *
     * @param   array       $selections
     * @return  Rend_View_Helper_Cycle_Container
     */
    public function cycle(array $selections)
    {
        $container = new Rend_View_Helper_Cycle_Container(
            new ArrayIterator(
                $selections
            )
        );
        $container->rewind();

        return $container;
    }

    /**
     * Strategy method
     *
     * @see     cycle()
     * @param   array   $selections
     * @return  Rend_View_Helper_Cycle_Container
     */
    public function direct(array $selections = array())
    {
        return $this->cycle(
            $selections
        );
    }

}
