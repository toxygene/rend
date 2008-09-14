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

/**
 * @category    Rend
 * @package     View
 */
class Rend_View_Helper_Truncate
{

    /**
     * Trucate a string
     *
     * Additional features include setting an ending string and attempting to
     * only truncate on word boundaries.
     *
     * @param   string      $string
     * @param   integer     $length
     * @param   string      $end
     * @param   boolean     $boundry
     * @return  string
     * @throws  InvalidArgumentException
     */
    public function truncate($string, $length, $end = '...', $boundry = false)
    {
        if ($length <= 0) {
            throw new InvalidArgumentException('Length must be greater than 0');
        }

        if (strlen($string) <= $length) {
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

        return substr($string, 0, $length) . $end;
    }

}
