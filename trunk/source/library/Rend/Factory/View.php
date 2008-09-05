<?php
/**
 *
 */

/** Rend_Factory_Abstract */
require_once 'Rend/Factory/Abstract.php';

/** Zend_View */
require_once 'Zend/View.php';

/**
 *
 */
class Rend_Factory_View extends Rend_Factory_Abstract
{

    /**
     *
     */
    public function create()
    {
        return new Zend_View();
    }

}
