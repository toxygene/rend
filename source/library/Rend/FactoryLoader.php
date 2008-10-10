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
     * Aliases
     * @var     array
     */
    protected $_aliases = array();

    /**
     * Config object
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
        parent::__construct(array(
            'Rend_Factory' => 'Rend/Factory'
        ));

        $this->_config = $config;

        if (isset($this->_config->prefixPaths)) {
            foreach ($this->_config->prefixPaths as $prefix => $path) {
                $this->addPrefixPath($prefix, $path);
            }
        }

        if (isset($this->_config->aliases)) {
            foreach ($this->_config->aliases as $alias => $factory) {
                $this->setAlias($alias, $factory);
            }
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
    public function setAlias($alias, $factory)
    {
        $this->_aliases[$alias] = $factory;
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
        $configName = $this->_lcFirst($name);
        $pluginName = $this->getPluginName($name);
        $className  = $this->load($pluginName);

        $class = new $className();
        $class->setFactoryLoader($this);

        if ($this->_config->$configName) {
            $class->setConfig($this->_config->$configName);
        }

        return $class;
    }

    /**
     *
     */
    public function getPluginName($name) {
        if (isset($this->_aliases[$name])) {
            $name = $this->_aliases[$name];
        }

        return $this->_lcFirst($name);
    }

    /**
     *
     */
    private function _lcFirst($string)
    {
        return strToLower(substr($string, 0, 1)) . substr($string, 1);
    }

}
