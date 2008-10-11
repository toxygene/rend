<?php
/**
 *
 */

/** Zend_Controller_Plugin_Abstract */
require_once 'Zend/Controller/Plugin/Abstract.php';

/**
 *
 */
class Rend_Controller_Plugin_Setup extends Zend_Controller_Plugin_Abstract
{

    /**
     *
     */
    protected $_config;

    /**
     *
     */
    protected $_factoryLoader;

    /**
     *
     */
    protected $_mode;

    /**
     *
     */
    protected $_root;

    /**
     *
     */
    public function __construct($root, $mode = null)
    {
        $this->_root = $root;
        $this->_mode = $mode;
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
             ->_setupViewRenderer()
             ->_setupFrontController();
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
                "{$this->_root}/application/config/config.ini",
                $this->_mode
            );
        }
        return $this->_config;
    }

    /**
     *
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
     *
     */
    protected function _getFrontController()
    {
        /** Zend_Controller_Front */
        require_once 'Zend/Controller/Front.php';

        return Zend_Controller_Front::getInstance();
    }

    /**
     *
     */
    protected function _setupActionHelperBroker()
    {
        /** Zend_Controller_Action_HelperBroker */
        require_once 'Zend/Controller/Action/HelperBroker.php';

        Zend_Controller_Action_HelperBroker::addPrefix('Rend_Controller_Action_Helper');

        return $this;
    }

    protected function _setupFrontController()
    {
        $this->_getFrontController()
             ->getDispatcher()
             ->setParam('rendConfig', $this->_getConfig())
             ->setParam('rendFactoryLoader', $this->_getFactoryLoader())
             ->setParam('rendRoot', $this->_root);

        $this->_getFrontController()
             ->throwExceptions($this->_getConfig()->displayErrors);

        return $this;
    }

    /**
     *
     */
    protected function _setupPhpEnvironment()
    {
        error_reporting(E_ALL | E_STRICT);

        ini_set('display_errors', $this->_getConfig()->displayErrors);
        ini_set('error_log', "{$this->_root}/data/logs/phperrors.log");
        ini_set('log_errors', true);

        date_default_timezone_set($this->_getConfig()->timezone);

        return $this;
    }

    /**
     *
     */
    protected function _setupViewRenderer()
    {
        if (isset($this->_getFactoryLoader()->view)) {
            /** Zend_Controller_Action_HelperBroker */
            require_once 'Zend/Controller/Action/HelperBroker.php';

            Zend_Controller_Action_HelperBroker::getStaticHelper('ViewRenderer')
                                               ->setView($this->_getFactoryLoader()->view());
        }
        return $this;
    }

}
