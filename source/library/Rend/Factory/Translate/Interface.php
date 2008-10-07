<?php
/**
 *
 */

/**
 *
 */
interface Rend_Factory_Translate_Interface
{

    /**
     * Create method for factory
     *
     * @return  Zend_Translate_Adapter
     */
    public function create();

    /**
     * Get the name of the factory
     *
     * @return  string
     */
    public function getName();

}
