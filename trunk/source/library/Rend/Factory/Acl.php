<?php
/**
 *
 */

/** Rend_Factory_Abstract */
require_once 'Rend/Factory/Abstract.php';

/** Rend_Factory_Acl_Interface */
require_once 'Rend/Factory/Acl/Interface.php';

/** Zend_Acl */
require_once 'Zend/Acl.php';

/** Zend_Acl_Resource */
require_once 'Zend/Acl/Resource.php';

/** Zend_Acl_Role */
require_once 'Zend/Acl/Role.php';

/**
 *
 */
class Rend_Factory_Acl extends Rend_Factory_Abstract implements Rend_Factory_Acl_Interface
{

    /**
     * Configuration file
     * @var     string
     */
    private $_configFile;

    /**
     * Get an ACL object
     *
     * @return  Zend_Acl
     */
    public function create()
    {
        $acl = new Zend_Acl();

        if ($this->_configFile) {
            include $this->_configFile;
        }

        return $acl;
    }

    /**
     *
     */
    public function setConfigFile($configFile)
    {
        $this->_configFile = $configFile;
        return $this;
    }

}
