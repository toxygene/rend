<?php
/**
 *
 */

/** Rend_Factory_Abstract */
require_once 'Rend/Factory/Abstract.php';

/** Rend_Factory_Auth_Interface */
require_once 'Rend/Factory/Auth/Interface.php';

/** Zend_Auth */
require_once 'Zend/Auth.php';

/**
 *
 */
class Rend_Factory_Auth extends Rend_Factory_Abstract implements Rend_Factory_Auth_Interface
{

    /**
     * Get an auth object
     *
     * @return  Zend_Auth
     */
    public function create()
    {
        return Zend_Auth::getInstance();
    }

}
