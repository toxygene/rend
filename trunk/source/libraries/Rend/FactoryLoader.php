<?php
/**
 *
 */

/** Zend_Loader_PluginLoader */
require_once 'Zend/Loader/PluginLoader.php';

/**
 *
 */
class Rend_FactoryLoader extends Zend_Loader_PluginLoader
{

    /**
     * Rend config object
     * @var     Zend_Config
     */
    private $_rendConfig;

    /**
     * Constructor
     *
     * @param   Zend_Config     $rendConfig
     */
    public function __construct(Zend_Config $rendConfig)
    {
        $this->_rendConfig = $rendConfig;

        $prefixPaths = array('Rend_Factory', 'Rend/Factory');
        if (isset($rendConfig->factoryPrefixPaths)) {
            $prefixPaths += $rendConfig->factoryPrefixPaths->toArray();
        }

        parent::__construct($prefixPaths);
    }

    /**
     * Member access overloader
     *
     * @param   string  $name
     * @return  mixed
     */
    public function __get($name)
    {
        return $this->getFactory($name);
    }

    /**
     * Get a factory by name
     *
     * @param   string  $name
     * @return  Rend_Factory_Interface
     */
    public function getFactory($name)
    {
        if (!$this->_factories[$name]) {
            $class = new ReflectionClass($this->load($name));
            if ($class->hasMethod('__construct')) {
                $this->_factories[$name] = $class->newInstanceArgs($this->_rendConfig);
            } else {
                $this->_factories[$name] = $class->newInstance();
            }
        }

        return $this->_factories[$name];
    }

}
