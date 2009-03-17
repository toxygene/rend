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

/** Rend_Base_Abstract */
require_once "Rend/Base/Abstract.php";

/** Rend_Factory_Log_Interface */
require_once "Rend/Factory/Log/Interface.php";

/**
 * Factory for building log objects
 *
 * @category Rend
 * @package Factory
 */
class Rend_Factory_Log extends Rend_Base_Abstract implements Rend_Factory_Log_Interface
{

    /**
     * Configuration file
     * @var string
     */
    protected $_configFile = "../application/configs/log.php";

    /**
     * Create a log object
     *
     * @return Zend_Log
     */
    public function create()
    {
        if (!file_exists($this->_configFile)) {
            /** Rend_Factory_Log_Exception */
            require_once "Rend/Factory/Log/Exception.php";

            throw new Rend_Factory_Log_Exception("Could not load config file '{$this->_configFile}'");
        }

        /** Zend_Log */
        require_once "Zend/Log.php";

        $log = new Zend_Log();

        include $this->_configFile;

        return $log;
    }

    /**
     * Set the config file
     *
     * @param string $configFile
     * @return Rend_Factory_Log
     */
    public function setConfigFile($configFile)
    {
        $this->_configFile = $configFile;
        return $this;
    }

}
