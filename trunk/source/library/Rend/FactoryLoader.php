<?php
/**
 *
 */

/** Zend_Loader_PluginLoader */
require_once "Zend/Loader/PluginLoader.php";

/**
 *
 */
class Rend_FactoryLoader extends Zend_Loader_PluginLoader
{

    /**
     * Factories
     * @var array
     */
    protected $_factories = array();

    /**
     * Constructor
     *
     * @param Zend_Config|array $options
     */
    public function __construct($options = null)
    {
        parent::__construct(array(
            "Rend_Factory" => "Rend/Factory"
        ));

        if ($options instanceof Zend_Config) {
            $this->setConfig($options);
        } elseif (is_array($options)) {
            $this->setOptions($options);
        }
    }

    /**
     * Method overloader
     *
     * @param string $name
     * @param array $arguments
     * @return mixed
     * @throws Zend_Loader_PluginLoader_Exception
     */
    public function __call($name, $arguments)
    {
        return $this->getFactory($name)
                    ->create();
    }

    /**
     * Member access overloader
     *
     * @param string $name
     * @return Rend_Factory_Interface
     * @throws Zend_Loader_PluginLoader_Exception
     */
    public function __get($name)
    {
        return $this->getFactory($name);
    }

    /**
     * Isset overloader
     *
     * @param string $name
     * @return boolean
     */
    public function __isset($name)
    {
        return isset($this->_factories[$name]);
    }

    /**
     * Member assignment overloader
     *
     * @param string $name
     * @param mixed $value
     */
    public function __set($name, $value)
    {
        $this->addFactory($name, $value);
    }

    /**
     * Member unset overloader
     *
     * @param string $name
     */
    public function __unset($name)
    {
        $this->removeFactory($name);
    }

    /**
     * Add a factory
     *
     * @param string $name
     * @param object|array|Zend_Config $factory
     * @return Rend_FactoryLoader
     */
    public function addFactory($name, $factory)
    {
        $this->_factories[$name] = $factory;
        return $this;
    }

    /**
     * Add factories
     *
     * @param Traversable $factories
     * @return Rend_FactoryLoader
     */
    public function addFactories($factories)
    {
        foreach ($factories as $name => $factory) {
            $this->addFactory($name, $factory);
        }
        return $this;
    }

    /**
     * Clear all the factories
     *
     * @return Rend_FactoryLoader
     */
    public function clearFactories()
    {
        $this->_factories = array();
        return $this;
    }

    /**
     * Get a factory by name
     *
     * @param string $name
     * @return object
     * @throws Rend_Factory_Exception
     * @throws Zend_Loader_PluginLoader_Exception
     */
    public function getFactory($name)
    {
        if (!isset($this->_factories[$name])) {
            /** Rend_Factory_Exception */
            require_once "Rend/Factory/Exception.php";
            throw new Rend_FactoryLoader_Exception(
                "Could not find a factory named '{$name}'"
            );
        }

        if (!$this->_factories[$name] instanceof Rend_Factory_Interface) {
            $this->_factories[$name] = $this->_buildFactory($this->_factories[$name]);
        }

        return $this->_factories[$name];
    }

    /**
     * Remove a factory
     *
     * @param string $name
     * @return Rend_FactoryLoader
     */
    public function removeFactory($name)
    {
        unset($this->_factories[$name]);
        return $this;
    }

    /**
     * Set all the factories
     *
     * @param Traversable $factories
     * @return Rend_FactoryLoader
     */
    public function setFactories($factories)
    {
        return $this->clearFactories()
                    ->addFactories($factories);
    }

    /**
     * Set options from a Zend_Config object
     *
     * @param Zend_Config $config
     * @return Rend_FactoryLoader
     */
    public function setConfig(Zend_Config $config)
    {
        return $this->setOptions($config->toArray());
    }

    /**
     * Set options from an array
     *
     * @param array $options
     * @return Rend_FactoryLoader
     */
    public function setOptions(array $options)
    {
        foreach ($options as $key => $value) {
            switch ($key) {
                case "prefixPaths":
                    foreach ($value as $prefix => $path) {
                        $this->addPrefixPath($prefix, $path);
                    }
                break;

                default:
                    $method = "set" . ucFirst($key);
                    if (method_exists($this, $method)) {
                        $this->$method($value);
                    }
                break;
            }
        }
        return $this;
    }

    /**
     * Construct a factory
     *
     * @param string $type
     * @param array|Zend_Config $config
     * @return object
     */
    protected function _buildFactory($config)
    {
        $className = $this->load(
            ucFirst($config["type"])
        );

        $factory = new $className();

        if (isset($config["options"]) && $factory instanceof Rend_Base_Interface) {
            if ($config["options"] instanceof Zend_Config) {
                $factory->setConfig($config["options"]);
            } elseif (is_array($config["options"])) {
                $factory->setOptions($config["options"]);
            }
        }

        return $factory;
    }

}
