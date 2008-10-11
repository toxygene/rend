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
     * Factories
     * @var 	array
     */
    protected $_factories = array();

    /**
     * Constructor
     *
     * @param 	Zend_Config|array 	$options
     */
    public function __construct($options)
    {
        parent::__construct(array(
            'Rend_Factory' => 'Rend/Factory'
        ));

        if ($options instanceof Zend_Config) {
            $this->setConfig($options);
        } else {
            $this->setOptions($options);
        }
    }

    /**
     * Method overloader
     *
     * @param   string  $name
     * @param   array   $arguments
     * @return  mixed
     * @throws  Zend_Loader_PluginLoader_Exception
     */
    public function __call($name, $arguments)
    {
        return $this->$name
                    ->create();
    }

    /**
     * Member access overloader
     *
     * @param   string  $name
     * @return  Rend_Factory_Interface
     * @throws  Zend_Loader_PluginLoader_Exception
     */
    public function __get($name)
    {
        return $this->getFactory($name);
    }

    /**
     *
     */
    public function __isset($name)
    {
        return isset($this->_factories[$name]);
    }

    /**
     * Add a factory
     *
     * @param	string	$name
     * @param	Rend_Factory_Interface|array 	$factory
     */
    public function addFactory($name, $factory)
    {
        $this->_factories[$name] = $factory;
        return $this;
    }

    /**
     * Get a factory by name
     *
     * @param   string  $name
     * @return  Rend_Factory_Interface
     * @throws  Zend_Loader_PluginLoader_Exception
     */
    public function getFactory($name)
    {
        if (!isset($this->_factories[$name])) {
            throw new Rend_FactoryLoader_Exception('no factory with that name found');
        }

        if (!$this->_factories[$name] instanceof Rend_Factory_Interface) {
            $className = $this->load($this->_factories[$name]['type']);
            $this->_factories[$name] = new $className($this->_factories[$name]['options']);
            $this->_factories[$name]->setFactoryLoader($this);
        }

        return $this->_factories[$name];
    }

    /**
     * Set options from a Zend_Config object
     *
     * @param 	Zend_Config 	$config
     * @return	Rend_FactoryLoader
     */
    public function setConfig(Zend_Config $config)
    {
        return $this->setOptions($config->toArray());
    }

    /**
     * Set options from an array
     *
     * @param 	array 	$options
     * @return	Rend_FactoryLoader
     */
    public function setOptions(array $options)
    {
        foreach ($options as $key => $value) {
            switch ($key) {
                case 'prefixPaths':
                    foreach ($value as $prefix => $path) {
                        $this->addPrefixPath($prefix, $path);
                    }
                break;

                case 'factory':
                    foreach ($value as $name => $factory) {
                        $this->addFactory($name, $factory);
                    }
                break;
            }
        }
        return $this;
    }

}
