<?php
/**
 *
 */

/** Rend_Factory_Interface */
require_once "Rend/Factory/Interface.php";

/**
 *
 */
interface Rend_Factory_Auth_Interface extends Rend_Factory_Interface
{

    /**
     * Create an authentication object
     *
     * @return Zend_Auth
     */
    public function create();

}
