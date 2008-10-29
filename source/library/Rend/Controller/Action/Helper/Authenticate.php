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
 * @package     Controller
 * @copyright   2008 Justin Hendrickson
 * @license     http://www.rendframework.com/license.html    New BSD License
 * @link        http://www.rendframework.com/
 * @since       2.0.0
 * @version     $Id$
 */

/** Zend_Controller_Action_Helper_Abstract */
require_once 'Zend/Controller/Action/Helper/Abstract.php';

/**
 * Authentication helper
 *
 * @category    Rend
 * @package     Controller
 */
class Rend_Controller_Action_Helper_Authenticate extends Zend_Controller_Action_Helper_Abstract
{

    /**
     * Auth object
     * @var     Zend_Auth
     */
    protected $_auth;

    /**
     * Authenticate a user
     *
     * @param   Zend_Auth_Adapter_Interface     $adapter
     * @return  Zend_Auth_Result
     */
    public function direct(Zend_Auth_Adapter_Interface $adapter)
    {
        if (!$this->_auth) {
            /** Zend_Controller_Action_Exception */
            require_once 'Zend/Controller/Action/Exception.php';
            throw new Zend_Controller_Action_Exception("You must provide an auth object before use");
        }

        return $this->_auth
                    ->create()
                    ->authenticate($adapter);
    }

    /**
     * Set the auth object
     *
     * @param   Zend_Auth   $auth
     * @return  Rend_Controller_Action_Helper_Auth
     */
    public function setAuth(Zend_Auth $auth)
    {
        $this->_auth = $auth;
        return $this;
    }

}
