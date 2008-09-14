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

        if (isset($this->_config->prefixPaths)) {
            foreach ($this->_config->prefixPaths as $prefix => $path) {
                $this->addPrefixPath($prefix, $path);
            }
        }
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
        return $this->getFactory($name)
                    ->create();
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
        $class = new $this->load($name);
        $name  = $class->getName();

        $class->setConfig($this->_config->$name)
              ->setFactoryLoader($this);

        return $class;
    }

}
