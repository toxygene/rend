<?php
/**
 *
 */

/** Rend_Base_Interface */
require_once "Rend/Base/Interface.php";

/**
 *
 */
abstract class Rend_Base_Abstract implements Rend_Base_Interface
{

    /**
     * Constructor
     *
     * @param array|Zend_Config $config
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
     * Set the options from a Zend_Config object
     *
     * @param Zend_Config $config
     * @return Rend_Controller_Action_Helper_Abstract
     */
    public function setConfig(Zend_Config $config)
    {
        return $this->setOptions($config->toArray());
    }

    /**
     * Set the options from an array
     *
     * @param array $options
     * @return Rend_Controller_Action_Helper_Abstract
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