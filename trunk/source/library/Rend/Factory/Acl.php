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
     * Configuration file target
     * @var     string
     */
    private $_configTarget = ':rendConfigPath/:filename.:suffix';

    /**
     * Get an ACL object
     *
     * @return  Zend_Acl
     */
    public function create()
    {
        $acl = new Zend_Acl();

        $inflector = $this->getRendInflector()
                          ->setTarget($this->getConfigTarget());

        include $inflector->filter(array(
            'filename'   => 'acl',
            'suffix'     => 'php'
        ));

        return $acl;
    }

    /**
     * Get the config target
     *
     * @return  string
     */
    public function getConfigTarget()
    {
        return $this->_configTarget;
    }

    /**
     * Set the config target
     *
     * The following sources will be applied to the target when filtered:
     * * rendPath: Path to the Rend directory
     * * rendConfigPath: Path to the configuration directory
     * * rendMode: Mode Rend is running in
     * * filename: Filename for the ACL configuration file
     * * suffix: Suffix for the ACL configuration file
     *
     * @param   string  $configTarget
     * @return  Rend_Factory_Acl
     */
    public function setConfigTarget($configTarget)
    {
        $this->_configTarget = $configTarget;
        return $this;
    }

}
