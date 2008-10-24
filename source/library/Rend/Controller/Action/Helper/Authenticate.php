<?php
/**
 *
 */

/** Zend_Controller_Action_Helper_Abstract */
require_once 'Zend/Controller/Action/Helper/Abstract.php';

/**
 *
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
        if (!$this->_acl) {
            /** Zend_Controller_Action_Exception */
            require_once 'Zend/Controller/Action/Exception.php';
            throw new Zend_Controller_Action_Exception('You must provide an auth object before use');
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
