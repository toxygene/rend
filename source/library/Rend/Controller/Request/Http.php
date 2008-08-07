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
 * @package     Controller
 * @copyright   2008 Justin Hendrickson
 * @license     http://rend.superglobals.com/license/new-bsd    New BSD License
 * @link        http://rend.superglboals.com/
 * @since       1.0.0
 * @version     $Id$
 */

/** Zend_Controller_Request_Http */
require_once 'Zend/Controller/Request/Http.php';

/**
 * Request handler
 *
 * @category Rend
 * @package  Controller
 */
class Rend_Controller_Request_Http extends Zend_Controller_Request_Http
{

    /**
     * Access values contained in the superglobals as public members
     * Order of precedence: 1. GET, 2. POST, 3. COOKIE, 4. SERVER, 5. ENV, 6. FILES
     *
     * @see     http://msdn.microsoft.com/en-us/library/system.web.httprequest.item.aspx
     * @param   string  $key
     * @return  mixed
     */
    public function __get($key)
    {
        $result = parent::__get($key);

        return ($result !== null) ? $result : $_FILES[$key];
    }

    /**
     * Check to see if a property is set
     *
     * @param   string $key
     * @return  boolean
     */
    public function __isset($key)
    {
        return parent::__isset($key) || isset($_FILES[$key]);
    }

    /**
     * Retrieve a member of the $_FILES superglobal
     *
     * If no $key is passed, returns the entire $_FILES array.
     *
     * @param   string $key
     * @param   mixed $default Default value to use if key not found
     * @return  mixed Returns null if key does not exist
     */
    public function getFile($key = null, $default = null)
    {
        if (null === $key) {
            return $_FILES;
        }

        return (isset($_FILES[$key])) ? $_FILES[$key] : $default;
    }

    /**
     * Determine if the request is an SSL request
     *
     * @return  boolean
     */
    public function isSsl()
    {
        if (!isset($this->HTTPS)) {
            return false;
        }

        return $this->HTTPS == 'on';
    }

}
