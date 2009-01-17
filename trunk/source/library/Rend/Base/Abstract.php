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
     *
     */
    public function setConfig(Zend_Config $config)
    {
        return $this->setOptions($config->toArray());
    }

    /**
     *
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