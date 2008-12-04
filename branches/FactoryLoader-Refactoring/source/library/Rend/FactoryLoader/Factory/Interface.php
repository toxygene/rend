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
     *
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
