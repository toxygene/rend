<?php
/**
 *
 */

/**
 *
 */
abstract class Rend_Factory_Abstract
{

    /**
     * Get the factory name
     *
     * @return string
     */
    public function getName()
    {
        $classname = get_class($this);

        if (preg_match('/.*_(.*)/', $classname, $matches)) {
            return $matches[1];
        }

        return $classname;
    }

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
            $method = 'set' . ucFirst($key);
            if (method_exists($this, $method)) {
                $this->$method($value);
            }
        }
        return $this;
    }

}
