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
 * @copyright 2008 Justin Hendrickson
 * @license http://www.rendframework.com/license.html New BSD License
 * @link http://www.rendframework.com/
 * @since 2.0.0
 * @version $Id$
 */

/** Rend_Base_Abstract */
require_once "Rend/Base/Abstract.php";

/** Rend_Factory_Acl_Interface */
require_once "Rend/Factory/Acl/Interface.php";

/**
 * @category Rend
 * @package Factory
 */
class Rend_Factory_Acl extends Rend_Base_Abstract implements Rend_Factory_Acl_Interface
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
