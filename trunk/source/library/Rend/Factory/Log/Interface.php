<?php
/**
 *
 */

/** Rend_Factory_Interface */
require_once "Rend/Factory/Interface.php";

/**
 *
 */
interface Rend_Factory_Log_Interface extends Rend_Factory_Interface
{

    /**
     * Create a log object
     *
     * @return Zend_Log
     */
    public function create();

}
