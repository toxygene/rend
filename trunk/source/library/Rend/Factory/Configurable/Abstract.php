<?php
/**
 *
 */

/** Rend_Factory_Abstract */
require_once 'Rend/Factory/Abstract.php';

/** Rend_Factory_Configurable_Interface */
require_once 'Rend/Factory/Configurable/Interface.php';

/**
 *
 */
abstract class Rend_Factory_Configurable_Abstract extends Rend_Factory_Abstract implements Rend_Factory_Configurable_Interface
{

    /**
     * Set the configuration with a Zend_Config object
     *
     * @param   Zend_Config     $config
     * @return  Rend_Factory_Configurable_Interface
     */
    public function setConfig(Zend_Config $config)
    {
        return $this->setOptions($config->toArray());
    }

    /**
     * Set the configuration with an array
     *
     * @param   array   $options
     * @return  Rend_Factory_Configurable_Interface
     */
    public function setOptions(array $options)
    {
        foreach ($options as $key => $value) {
            $method = 'set' . ucfirst($key);
            if (method_exists($method, $this)) {
                $this->$method($value);
            }
        }
        return $this;
    }

}
