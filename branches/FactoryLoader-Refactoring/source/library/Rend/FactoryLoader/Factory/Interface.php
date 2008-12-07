<?php
/**
 *
 */

/**
 *
 */
interface Rend_FactoryLoader_Factory_Interface
{

    /**
     * Constructor
     *
     * @param Zend_Config|array $config
     */
    public function __construct($config = null);

    /**
     *
     */
    public function setConfig(Zend_Config $config);

    /**
     *
     */
    public function setOptions(array $options);

}
