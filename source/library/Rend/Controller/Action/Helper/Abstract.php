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

/** Zend_Controller_Action_HelperBroker */
require_once 'Zend/Controller/Action/HelperBroker.php';

/**
 * Extended helper abstract
 *
 * @category Rend
 * @package Controller
 */
abstract class Rend_Controller_Action_Helper_Abstract extends Zend_Controller_Action_Helper_Abstract
{

    /**
     * Factory loader
     * @var Zend_FactoryLoader
     */
    protected $_factoryLoader;

    /**
     * Constructor
     *
     * @param array|Zend_Config $options
     */
    public function __construct($options = null)
    {
        if ($options instanceof Zend_Config) {
            $this->setConfig($options);
        } elseif (is_array($options)) {
            $this->setOptions($options);
        }
    }

    /**
     * Get the factory loader
     *
     * @return Rend_FactoryLoader
     */
    public function getFactoryLoader()
    {
        if (!$this->_factoryLoader) {
            $this->_factoryLoader = $this->getActionController()
                                         ->getHelper("factoryLoader")
                                         ->getFactoryLoader();
        }
        return $this->_factoryLoader;
    }

    /**
     * Set the options from a Zend_Config object
     *
     * @param Zend_Config $config
     * @return Rend_Controller_Action_Helper_Abstract
     */
    public function setConfig(Zend_Config $config)
    {
        return $this->setOptions($config->toArray());
    }

    /**
     * Set the factory loader
     *
     * @param Rend_FactoryLoader $factoryLoader
     * @return Rend_Controller_Action_Helper
     */
    public function setFactoryLoader(Rend_FactoryLoader $factoryLoader)
    {
        $this->_factoryLoader = $factoryLoader;
        return $this;
    }

    /**
     * Set the options from an array
     *
     * @param array $options
     * @return Rend_Controller_Action_Helper_Abstract
     */
    public function setOptions(array $options)
    {
        foreach ($options as $key => $value) {
            $method = "set" . ucfirst($key);
            if (method_exists($this, $method)) {
                $this->$method($value);
            }
        }
        return $this;
    }

    /**
     * Get the current action name
     *
     * @return string
     */
    protected function _getCurrentActionName()
    {
        $action = $this->getRequest()
                       ->getActionName();

        if (!$action) {
            $action = $this->getFrontController()
                           ->getDispatcher()
                           ->getDefaultAction();
        }

        return $action;
    }

}
