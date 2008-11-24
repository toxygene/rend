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
require_once "Zend/Controller/Plugin/Abstract.php";

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
     * Environment mode
     * @var string
     */
    protected $_environment;

    /**
     * Factory loader object
     * @var     Rend_FactoryLoader
     */
    protected $_factoryLoader;

    /**
     * Constructor
     *
     * @param string $environment
     */
    public function __construct($environment)
    {
        $this->_environment = $environment;

        $this->_setupActionHelperBroker()
             ->_setupLayout()
             ->_setupPhpEnvironment()
             ->_setupFrontController();

        $this->_init();
    }

    /**
     * Get the config object
     *
     * @var Zend_Config
     */
    protected function _getConfig()
    {
        if (!$this->_config) {
            /** Zend_Config_Ini */
            require_once "Zend/Config/Ini.php";

            $this->_config = new Zend_Config_Ini(
                "../application/configs/config.ini",
                $this->_environment
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
            require_once "Rend/FactoryLoader.php";

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
        require_once "Zend/Controller/Front.php";

        return Zend_Controller_Front::getInstance();
    }

    /**
     * Overloadable method called at the end of __construct()
     *
     * @see __construct
     */
    protected function _init()
    {}

    /**
     * Setup the action helper broker
     *
     * @return  Rend_Controller_Plugin_Setup
     */
    private function _setupActionHelperBroker()
    {
        /** Zend_Controller_Action_HelperBroker */
        require_once "Zend/Controller/Action/HelperBroker.php";

        Zend_Controller_Action_HelperBroker::addPrefix("Rend_Controller_Action_Helper");

        return $this;
    }

    /**
     * Setup the front controller
     *
     * @return  Rend_Controller_Plugin_Setup
     */
    private function _setupFrontController()
    {
        $this->_getFrontController()
             ->setParam("rendConfig", $this->_getConfig())
             ->setParam("rendFactoryLoader", $this->_getFactoryLoader())
             ->throwExceptions($this->_getConfig()->displayErrors);

        $this->_getFrontController()
             ->getDispatcher()
             ->setParam("rendConfig", $this->_getConfig())
             ->setParam("rendFactoryLoader", $this->_getFactoryLoader());

        return $this;
    }

    /**
     * Setup Zend_Layout
     *
     * @return Rend_Controller_Plugin_Setup
     */
    private function _setupLayout()
    {
        Zend_Layout::startMvc("../application/layouts");

        return $this;
    }

    /**
     * Setup the PHP environment
     *
     * @return  Rend_Controller_Plugin_Setup
     */
    private function _setupPhpEnvironment()
    {
        error_reporting(E_ALL | E_STRICT);

        ini_set("display_errors", $this->_getConfig()->displayErrors);
        ini_set("error_log", "../data/logs/phperrors.log");
        ini_set("log_errors", true);

        date_default_timezone_set($this->_getConfig()->timezone);

        return $this;
    }

}