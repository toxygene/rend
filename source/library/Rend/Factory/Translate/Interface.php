<?php
/**
 *
 */

/**
 *
 */
interface Rend_Factory_Translate_Interface extends Rend_Factory_Interface
{

    /**
     * Create method for factory
     *
     * @return  Zend_Translate_Adapter
     */
    public function create();

}
