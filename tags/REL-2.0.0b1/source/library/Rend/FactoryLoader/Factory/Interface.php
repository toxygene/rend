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
    public function create();

    /**
     *
     */
    public function setConfig(Zend_Config $config);

    /**
     *
     */
    public function setOptions(array $options);

}
