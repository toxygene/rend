<?php
/**
 *
 */

/** Rend_Factory_Interface */
require_once 'Rend/Factory/Interface.php';

/**
 *
 */
interface Rend_Factory_View_Interface extends Rend_Factory_Interface
{

    /**
     * Create method for factory
     *
     * @return  Zend_View_Interface
     */
    public function create();

}
