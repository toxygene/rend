<?php
/**
 *
 */

/** Rend_Factory_Interface */
require_once 'Rend/Factory/Interface.php';

/**
 *
 */
abstract class Rend_Factory_Abstract implements Rend_Factory_Interface
{

    /**
     * Rend config
     * @var     Zend_Config
     */
    protected $_config;

    /**
     * Constructor
     *
     * @param   Zend_Config     $config
     */
    public function __construct(Zend_Config $config)
    {
        $this->_config = $config;
        $this->_init();
    }

    /**
     * Get the factory name
     *
     * @return string
     */
    public function getName()
    {
        $class = new ReflectionClass($this);

        if (preg_match('/.*_(.*)/', $class->getName(), $matches)) {
            return $matches[1];
        } else {
            return $class->getName();
        }
    }

    /**
     * Initialize the factory
     */
    protected function _init()
    {
    }

}
