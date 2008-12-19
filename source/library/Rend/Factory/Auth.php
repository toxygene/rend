<?php
/**
 *
 */

/** Rend_FactoryLoader_Factory_Abstract */
require_once "Rend/FactoryLoader/Factory/Abstract.php";

/**
 *
 */
class Rend_Factory_Auth extends Rend_FactoryLoader_Factory_Abstract
{

    /**
     * Create an auth object
     *
     * @return Zend_Auth
     */
    public function create()
    {
		/** Zend_Auth */
		require_once "Zend/Auth.php";

        return Zend_Auth::getInstance();
    }

}
