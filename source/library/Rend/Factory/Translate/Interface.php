<?php
/**
 *
 */

/** Rend_Factory_Interface */
require_once "Rend/Factory/Interface.php";

/**
 *
 */
interface Rend_Factory_Translator_Interface extends Rend_Factory_Interface
{

    /**
     * Create a translator object
     *
     * @return Zend_Translator_Adapter
     */
    public function create();

}
