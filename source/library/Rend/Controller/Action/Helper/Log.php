<?php
/**
 *
 */

/** Rend_Controller_Action_Helper_Abstract */
require_once 'Rend/Controller/Action/Helper/Abstract.php';

/**
 *
 */
class Rend_Controller_Action_Helper_Log extends Rend_Controller_Action_Helper_Abstract
{

    /**
     *
     */
    public function direct($message, $level)
    {
        return $this->getActionController()
                    ->getFactory('log')
                    ->create()
                    ->log($message, $level);
    }

}
