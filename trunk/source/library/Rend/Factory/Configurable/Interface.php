<?php
/**
 *
 */

/** Rend_Factory_Interface */
require_once 'Rend/Factory/Interface.php';

/**
 *
 */
interface Rend_Factory_Configurable_Interface extends Rend_Factory_Interface
{

    /**
     * Set the configuration with a Zend_Config object
     *
     * @param   Zend_Config     $config
     * @return  Rend_Factory_Configurable_Interface
     */
    public function setConfig(Zend_Config $config);

    /**
     * Set the configuration with an array
     *
     * @param   array   $options
     * @return  Rend_Factory_Configurable_Interface
     */
    public function setOptions(array $options);

}
