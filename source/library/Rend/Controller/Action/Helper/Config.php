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
 * @package Controller
 * @copyright 2008 Justin Hendrickson
 * @license http://www.rendframework.com/license.html    New BSD License
 * @link http://www.rendframework.com/
 * @since 1.0.0
 * @version $Id$
 */

/** Zend_Controller_Action_Helper_Abstract */
require_once "Zend/Controller/Action/Helper/Abstract.php";

/**
 * Helper for loading the config from the front controller
 *
 * @category Rend
 * @package Controller
 */
class Rend_Controller_Action_Helper_Config extends Zend_Controller_Action_Helper_Abstract
{

    /**
     * Config object
     * @var Zend_Config
     */
    private $_config;

    /**
     * Proxies to getConfig()
     *
     * @return Zend_Config
     */
    public function direct()
    {
        return $this->getConfig();
    }

    /**
     * Get the config
     *
     * @return Zend_Config
     */
    public function getConfig()
    {
        if (!$this->_config) {
            $this->_config = Zend_Controller_Front::getInstance()
                                                  ->getParam("rendConfig");
        }

        return $this->_config;
    }

    /**
     * Set the config
     *
     * @param Zend_Config $config
     * @return Rend_Controller_Action_Helper_Config
     */
    public function setConfig(Zend_Config $config)
    {
        $this->_config = $config;
        return $this;
    }

}
