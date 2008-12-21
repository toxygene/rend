<?php
/**
 *
 */

/** Rend_FactoryLoader_Factory_Abstract */
require_once "Rend/FactoryLoader/Factory/Abstract.php";

/** Rend_Factory_Acl_Interface */
require_once "Rend/Factory/Acl/Interface.php";

/**
 *
 */
class Rend_Factory_Acl extends Rend_FactoryLoader_Factory_Abstract implements Rend_Factory_Acl_Interface
{

    /**
     * Configuration file
     * @var string
     */
    private $_configFile = "../application/configs/acl.php";

    /**
     * Create an ACL object
     *
     * @return Zend_Acl
     * @throws Rend_Factory_Acl_Exception
     */
    public function create()
    {
        if (!file_exists($this->_configFile)) {
            /** Rend_Factory_Acl_Exception */
            require_once "Rend/Factory/Acl/Exception.php";

            throw new Rend_Factory_Acl_Exception("Could not load config file '{$this->_configFile}'");
        }

		/** Zend_Acl */
		require_once "Zend/Acl.php";

		/** Zend_Acl_Resource */
		require_once "Zend/Acl/Resource.php";

		/** Zend_Acl_Role */
		require_once "Zend/Acl/Role.php";

		$acl = new Zend_Acl();

		include $this->_configFile;

        return $acl;
    }

    /**
     * Set the configuration file
     *
     * @param string $configFile
     * @return Rend_Factory_Acl
     */
    public function setConfigFile($configFile)
    {
        $this->_configFile = $configFile;
        return $this;
    }

}
