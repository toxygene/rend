<?php
/**
 * Rend
 *
 * This source file is subject to the new BSD license that is bundled
 * with this package in the file LICENSE.txt.
 * It is also available through the world-wide-web at this URL:
 * http://www.rendframework.com/license.html
 * If you did not receive a copy of the license and are unable to
 * obtain it through the world-wide-web, please send an email
 * to justin.hendrickson+rend@gmail.com so I can send you a copy immediately.
 *
 * @category Rend
 * @package Factory
 * @copyright 2008-2009 Justin Hendrickson
 * @license http://www.rendframework.com/license.html New BSD License
 * @link http://www.rendframework.com/
 * @since 2.0.0
 * @version $Id$
 */

/** Zend_Loader_PluginLoader */
require_once "Zend/Loader/PluginLoader.php";

/**
 * Plugin loader for factories
 *
 * @category Rend
 * @package Factory
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
     * @param array|Zend_Config $config
     * @return Zend_Factory_Interface
     */
    protected function _buildFactory($config)
    {
        if (is_array($config)) {
            /** Zend_Config */
            require_once "Zend/Config.php";

            $config = new Zend_Config($config);
        }

        $className = $this->load(
            ucFirst($config->type)
        );

        if (isset($config->options)) {
            $factory = new $className($config->options);
        } else {
            $factory = new $className();
        }

        return $factory;
    }

}
