<?php
/**
 *
 */

/** Rend_Factory_Interface */
require_once "Rend/Factory/Interface.php";

/**
 *
 */
interface Rend_Factory_Mail_Interface extends Rend_Factory_Interface
{

    /**
     * Create a mail object
     *
     * @return Zend_Mail
     */
    public function create();

}
