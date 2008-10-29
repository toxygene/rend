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
 * @category    Rend
 * @package     Controller
 * @copyright   2008 Justin Hendrickson
 * @license     http://www.rendframework.com/license.html    New BSD License
 * @link        http://www.rendframework.com/
 * @since       2.0.0
 * @version     $Id$
 */

/** Zend_Controller_Plugin_Abstract */
require_once 'Zend/Controller/Plugin/Abstract.php';

/**
 * Rend setup plugin
 *
 * @category    Rend
 * @package     Controller
 */
class Rend_Controller_Plugin_Setup extends Zend_Controller_Plugin_Abstract
{

    /**
     * Configuration object
     * @var     Zend_Config
     */
    protected $_config;

    /**
     * Factory loader object
     * @var     Rend_FactoryLoader
     */
    protected $_factoryLoader;

    /**
     * Constructor
     *
     * @param   array|Zend_Config   $options
     */
    public function __construct($options = null)
    {
        if (is_array($options)) {
            $this->setOptions($options);
        } elseif ($options instanceof Zend_Config) {
            $this->setConfig($options);
        }
    }

    /**
     * Called before Zend_Controller_Front begins evaluating the
     * request against its routes.
     *
     * @param   Zend_Controller_Request_Abstract    $request
     */
    public function routeStartup(Zend_Controller_Request_Abstract $request)
    {
        $this->_setupActionHelperBroker()
             ->_setupPhpEnvironment()
             ->_setupFrontController();
    }

    /**
     * Set options from a Zend_Config object
     *
     * @param     Zend_Config     $config
     * @return    Rend_FactoryLoader
     */
    public function setConfig(Zend_Config $config)
    {
        return $this->setOptions($config->toArray());
    }

    /**
     * Set options from an array
     *
     * @param     array     $options
     * @return    Rend_FactoryLoader
     */
    public function setOptions(array $options)
    {
        foreach ($options as $key => $value) {
            $method = 'set' . ucWords($key);
            if (method_exists($this, $method)) {
                $this->$method($value);
            }
        }
        return $this;
    }

    /**
     *
     */
    protected function _getConfig()
    {
        if (!$this->_config) {
            /** Zend_Config_Ini */
            require_once 'Zend/Config/Ini.php';

            $this->_config = new Zend_Config_Ini(
                "../application/configs/config.ini",
                $this->_getFrontController()
                     ->getParam('env')
            );
        }
        return $this->_config;
    }

    /**
     * Get the factory loader
     *
     * Lazy loads the default factory loader if none is present
     *
     * @return  Rend_FactoryLoader
     */
    protected function _getFactoryLoader()
    {
        if (!$this->_factoryLoader) {
            /** Rend_FactoryLoader */
            require_once 'Rend/FactoryLoader.php';

            $this->_factoryLoader = new Rend_FactoryLoader(
                $this->_getConfig()
                     ->factoryLoader
            );
        }
        return $this->_factoryLoader;
    }

    /**
     * Get the front controller
     *
     * @return  Zend_Controller_Front
     */
    protected function _getFrontController()
    {
        /** Zend_Controller_Front */
        require_once 'Zend/Controller/Front.php';

        return Zend_Controller_Front::getInstance();
    }

    /**
     * Setup the action helper broker
     *
     * @return  Rend_Controller_Plugin_Setup
     */
    protected function _setupActionHelperBroker()
    {
        /** Zend_Controller_Action_HelperBroker */
        require_once 'Zend/Controller/Action/HelperBroker.php';

        Zend_Controller_Action_HelperBroker::addPrefix('Rend_Controller_Action_Helper');

        return $this;
    }

    /**
     * Setup the front controller
     *
     * @return  Rend_Controller_Plugin_Setup
     */
    protected function _setupFrontController()
    {
        $this->_getFrontController()
             ->getDispatcher()
             ->setParam('rendConfig', $this->_getConfig())
             ->setParam('rendFactoryLoader', $this->_getFactoryLoader());

        $this->_getFrontController()
             ->throwExceptions($this->_getConfig()->displayErrors);

        return $this;
    }

    /**
     * Setup the PHP environment
     *
     * @return  Rend_Controller_Plugin_Setup
     */
    protected function _setupPhpEnvironment()
    {
        error_reporting(E_ALL | E_STRICT);

        ini_set('display_errors', $this->_getConfig()->displayErrors);
        ini_set('error_log', "../data/logs/phperrors.log");
        ini_set('log_errors', true);

        date_default_timezone_set($this->_getConfig()->timezone);

        return $this;
    }

}
