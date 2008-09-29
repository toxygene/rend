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
     *
     */
    public function direct(Zend_Auth_Adapter_Interface $adapter)
    {
        return $this->getActionController()
                    ->getFactory('auth')
                    ->create()
                    ->authenticate($adapter);
    }

}
