<?php
/**
 *
 */

/** Zend_Controller_Action_Helper_Abstract */
require_once 'Zend/Controller/Action/Helper/Abstract.php';

/**
 *
 */
class Rend_Controller_Action_Helper_Acl extends Zend_Controller_Action_Helper_Abstract
{

    /**
     *
     */
    public function direct($role, $resource, $permission = null)
    {
        return $this->getActionController()
                    ->getFactory('acl')
                    ->create()
                    ->isAllowed($role, $resource, $permission);
    }

}
