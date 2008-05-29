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
 * @package     Utilities
 * @copyright   2008 Justin Hendrickson
 * @license     http://rend.superglobals.com/license/new-bsd    New BSD License
 * @link        http://rend.superglboals.com/
 * @since       1.0.0
 * @version     $Id$
 */

/**
 * @category    Rend
 * @package     Utilities
 */
class Rend_Utilities
{

    static public $printableCharacters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789`~!@#$%^&*()-_=+[{]}\|;:\'",<.>/? ';

    /**
     * Generate a random string of printable characters
     *
     * @param  integer $length Length of the returned string
     * @param  string $characters
     * @return string
     */
    static public function generateRandomString($length = 8, $characters = null)
    {
        if (!$characters) {
            $characters = self::$printableCharacters;
        }

        $string = '';
        for($i = 0; $i < $length; ++$i) {
            $string .= $characters[mt_rand(0, strlen($characters) - 1)];
        }
        return $string;
    }

}
