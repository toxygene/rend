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
 * @copyright 2008 Justin Hendrickson
 * @license http://www.rendframework.com/license.html    New BSD License
 * @link http://www.rendframework.com/
 * @since 1.0.0
 * @version $Id$
 */

/**
 * @category Rend
 */
class Rend_Random
{

    /**
     * String of printable characters
     * @var string
     */
    const BASIC = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789`~!@#$%^&*()-_=+[{]}\\|;:'\",<.>/? ";

    /**
     * Generate a random string of printable characters
     *
     * @param integer $length Length of the returned string
     * @param string $characters
     * @return string
     */
    public function getString($length = 8, $characters = self::BASIC)
    {
        $charactersCount = strlen($characters);
        $string          = "";

        for($i = 0; $i < $length; ++$i) {
            $string .= $characters[mt_rand(0, $charactersCount - 1)];
        }

        return $string;
    }

}
