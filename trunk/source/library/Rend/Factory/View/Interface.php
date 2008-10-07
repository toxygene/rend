<?php
/**
 *
 */

/**
 *
 */
interface Rend_Factory_View_Interface
{

    /**
     * Create method for factory
     *
     * @return  Zend_View_Interface
     */
    public function create();

    /**
     * Get the name of the factory
     *
     * @return  string
     */
    public function getName();

}
