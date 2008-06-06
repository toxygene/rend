<?php
/**
 *
 */

/** Zend_Validate_Abstract */
require_once 'Zend/Validate/Abstract.php';

/**
 *
 */
abstract class Rend_Validate_Abstract extends Zend_Validate_Abstract
{

    /**
     * Constructor
     *
     * @param   array|Zend_Config   $options
     */
    public function __construct($options = null)
    {
        if ($options) {
            if ($options instanceof Zend_Config) {
                $this->setConfig($options);
            } elseif (is_array($options)) {
                $this->setOptions($options);
            } else {
                /** Rend_Validate_Exception */
                require_once 'Rend/Validate/Exception.php';
                throw new Rend_Validate_Exception('Invalid options');
            }
        }
    }

    /**
     * Set options from a config object
     *
     * @param   Zend_Config     $config
     * @return  Rend_Controller_Action_Helper_Abstract
     */
    public function setConfig(Zend_Config $config)
    {
        return $this->setOptions($config->toArray();
    }

    /**
     * Set options from an array
     *
     * @param   array   $options
     * @return  Rend_Controller_Action_Helper_Abstract
     */
    public function setOptions(array $options)
    {
        foreach ($options as $key => $value) {
            $method = 'set' . ucfirst($key);
            if (method_exists($this, $method)) {
                $this->$method($value);
            }
        }
        return $this;
    }

}
