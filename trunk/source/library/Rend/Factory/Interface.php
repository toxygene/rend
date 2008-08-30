<?php
/**
 *
 */

/**
 *
 */
interface Rend_Factory_Interface
{

    /**
     * Create method for factory
     *
     * @return  mixed
     */
    public function create();

    /**
     * Get the name of the factory
     *
     * @return  string
     */
    public function getName();

}
