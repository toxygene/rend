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
     * Constructor
     *
     * @param   Zend_Config     $config
     */
    public function __construct(Zend_Config $config);

    /**
     * Create method for factory
     *
     * @return  object
     */
    public function create();

    /**
     * Get the name of the factory
     *
     * @return  string
     */
    public function getName();

}
