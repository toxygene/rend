<?php
/**
 *
 */

/** Zend_Controller_Action_Helper_Abstract */
require_once 'Zend/Controller/Action/Helper/Abstract.php';

/**
 *
 */
class Rend_Controller_Action_Helper_Auth extends Zend_Controller_Action_Helper_Abstract
{

    /**
     * Auth object
     * @var     Zend_Auth
     */
    private $_auth;

    /**
     * Get the auth object
     *
     * @return  Zend_Auth
     */
    public function direct()
    {
        return $this->getAuth();
    }

    /**
     * Get the auth object
     *
     * @return  Zend_Auth
     */
    public function getAuth()
    {
        if (!$this->_auth) {
            /** Zend_Auth */
            require_once 'Zend/Auth.php';
            $this->_auth = Zend_Auth::getInstance();
        }
        return $this->_auth;
    }

    /**
     * Set the auth object
     *
     * @param   Zend_Auth   $auth
     * @return  Rend_Controller_Action_Helper_Auth
     */
    public function setAuth(Zend_Auth $auth = null)
    {
        $this->_auth = $auth;
        return $this;
    }

}
