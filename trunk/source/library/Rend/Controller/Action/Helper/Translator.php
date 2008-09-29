<?php
/**
 *
 */

/** Zend_Controller_Action_Helper_Abstract */
require_once 'Zend/Controller/Action/Helper/Abstract.php';

/**
 *
 */
class Rend_Controller_Action_Helper_Translator extends Zend_Controller_Action_Helper_Abstract
{

    /**
     *
     */
    public function direct($messageId, $locale = null)
    {
        return $this->getActionController()
                    ->getFactory('translator')
                    ->create()
                    ->translate($messageId, $locale);
    }

}
