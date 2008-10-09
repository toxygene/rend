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
     * Config object
     * @var     Zend_Config
     */
    private $_config;

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

        foreach ((array) $this->_config->prefixPaths as $prefix => $path) {
            $this->addPrefixPath($prefix, $path);
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
     * Get a factory by name
     *
     * @param   string  $name
     * @return  Rend_Factory_Interface
     * @throws  Zend_Loader_PluginLoader_Exception
     */
    public function getFactory($name)
    {
        $classname = $this->load($name);

        $class = new $classname();
        $name  = $class->getName();

        $class->setFactoryLoader($this);

        $configName = $this->_lcFirst($name);

        if ($this->_config->$configName) {
            $class->setConfig($this->_config->$configName);
        }

        return $class;
    }

    /**
     *
     */
    private function _lcFirst($string)
    {
        return strToLower(substr($string, 0, 1)) . substr($string, 1);
    }

}
