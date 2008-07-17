<?php
/**
 *
 */

/** Rend_Controller_Action_Helper_Abstract */
require_once 'Rend/Controller/Action/Helper/Abstract.php';

/**
 *
 */
class Rend_Controller_Action_Helper_Translator extends Rend_Controller_Action_Helper_Abstract implements SplObserver
{

    /**
     *
     */
    public function direct($key)
    {
        return $this->_factory
                    ->translator
                    ->translate($key);
    }

}
