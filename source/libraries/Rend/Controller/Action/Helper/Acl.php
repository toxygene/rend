<?php
/**
 *
 */

/** Rend_Controller_Action_Helper_Abstract */
require_once 'Rend/Controller/Action/Helper/Abstract.php';

/**
 *
 */
class Rend_Controller_Action_Helper_Acl extends Rend_Controller_Action_Helper_Abstract
{

    /**
     *
     */
    public function direct($role, $resource, $permission = null)
    {
        return $this->_factory
                    ->acl
                    ->isAllowed($role, $resource, $permission);
    }

}
