<?php
/**
 *
 */

/** Rend_FactoryLoader_Factory_Interface */
require_once "Rend/FactoryLoader/Factory/Interface.php";

/**
 *
 */
abstract class Rend_FactoryLoader_Factory_Abstract implements Rend_FactoryLoader_Factory_Interface
{

    /**
     * Constructor
     *
     * @param Zend_Config|array $config
     */
    public function __construct($config = null)
     {
         if ($config instanceof Zend_Config) {
             $this->setConfig($config);
         } elseif (is_array($config)) {
             $this->setOptions($config);
         }
     }

    /**
     * Set options with a Zend_Config object
     *
     * @param Zend_Config $config
     * @return Rend_FactoryLoader_Factory_Abstract
     */
    public function setConfig(Zend_Config $config)
    {
        return $this->setOptions($config->toArray());
    }

    /**
     * Set options with an array
     *
     * @param array $options
     * @return Rend_FactoryLoader_Factory_Abstract
     */
    public function setOptions(array $options)
    {
        foreach ($options as $key => $value) {
            $method = "set" . ucFirst($key);
            if (method_exists($this, $method)) {
                $this->$method($value);
            }
        }
        return $this;
    }

}
