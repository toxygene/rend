<?php
/**
 * Rend
 *
 * This source file is subject to the new BSD license that is bundled
 * with this package in the file LICENSE.txt.
 * It is also available through the world-wide-web at this URL:
 * http://rend.superglobals.com/license/new-bsd
 * If you did not receive a copy of the license and are unable to
 * obtain it through the world-wide-web, please send an email
 * to justin.hendrickson+rend@gmail.com so I can send you a copy immediately.
 *
 * @category    Rend
 * @package     Controller
 * @copyright   2008 Justin Hendrickson
 * @license     http://rend.superglobals.com/license/new-bsd    New BSD License
 * @link        http://rend.superglboals.com/
 * @since       1.0.0
 * @version     $Id$
 */

/** Zend_Controller_Action_HelperBroker */
require_once 'Zend/Controller/Action/HelperBroker.php';

/** Zend_Controller_Front */
require_once 'Zend/Controller/Front.php';

/**
 * Front controller
 *
 * @category Rend
 * @package  Controller
 */
class Rend_Controller_Front extends Zend_Controller_Front
{

    /**
     * Singleton instance
     *
     * @return  Rend_Controller_Front
     */
    public static function getInstance()
    {
        if (null === self::$_instance) {
            self::$_instance = new self();
        }
        return self::$_instance;
    }

#    /**
#     * Dispatch an HTTP request to a controller/action.
#     *
#     * @param Zend_Controller_Request_Abstract|null $request
#     * @param Zend_Controller_Response_Abstract|null $response
#     * @return void|Zend_Controller_Response_Abstract Returns response object if returnResponse() is true
#     */
#    public function dispatch(Zend_Controller_Request_Abstract $request = null, Zend_Controller_Response_Abstract $response = null)
#    {
#        if (!$this->getParam('noViewRenderer') && !Zend_Controller_Action_HelperBroker::hasHelper('viewRenderer')) {
#            require_once 'Rend/Controller/Action/Helper/ViewRenderer.php';
#            Zend_Controller_Action_HelperBroker::addHelper(new Rend_Controller_Action_Helper_ViewRenderer());
#        }

#        /**
#         * Instantiate default request object (HTTP version) if none provided
#         */
#        if (null !== $request) {
#            $this->setRequest($request);
#        } elseif ((null === $request) && (null === ($request = $this->getRequest()))) {
#            /** Rend_Controller_Request_Http */
#            require_once 'Rend/Controller/Request/Http.php';
#            $this->setRequest(new Rend_Controller_Request_Http());
#        }

#        /**
#         * Instantiate default response object (HTTP version) if none provided
#         */
#        if (null !== $response) {
#            $this->setResponse($response);
#        } elseif ((null === $this->_response) && (null === ($this->_response = $this->getResponse()))) {
#            require_once 'Zend/Controller/Response/Http.php';
#            $response = new Zend_Controller_Response_Http();
#            $this->setResponse($response);
#        }

#        $this->getResponse()->setHeader(
#            'Content-type',
#             "text/html; charset={$this->getConfig()->encoding}"
#         );

#        try {
#            $this->enableIsAllowedHelper()
#                 ->enableLayoutSelectorHelper()
#                 ->enableSslSelectorHelper();
#        } catch (Exception $e) {
#            if ($this->throwExceptions()) {
#                throw $e;
#            }

#            $this->_response->setException($e);
#        }

#        parent::dispatch($request, $response);
#    }

#    /**
#     * Enable the IsAllowed helper
#     *
#     * @return  Rend_Controller_Front
#     */
#    public function enableIsAllowedHelper()
#    {
#        if ($this->getParam('noIsAllowed') || Zend_Controller_Action_HelperBroker::hasHelper('isAllowed')) {
#            return $this;
#        }

#        $storage = Zend_Controller_Action_HelperBroker::getStaticHelper('auth')
#                                                      ->getAuth()
#                                                      ->getStorage();

#        $role = null;
#        if (!$storage->isEmpty()) {
#            $role = $storage->read()->role;
#        }

#        /** Rend_Controller_Action_Helper_IsAllowed */
#        require_once 'Rend/Controller/Action/Helper/IsAllowed.php';

#        Zend_Controller_Action_HelperBroker::addHelper(
#            new Rend_Controller_Action_Helper_IsAllowed(null, $role)
#        );

#        return $this;
#    }

#    /**
#     * Enable the layout selector helper
#     *
#     * @return  Rend_Controller_Front
#     */
#    public function enableLayoutSelectorHelper()
#    {
#        if ($this->getParam('noLayoutSelector') || Zend_Controller_Action_HelperBroker::hasHelper('layoutSelector')) {
#            return $this;
#        }

#        /** Zend_Layout */
#        require_once 'Zend/Layout.php';

#        Zend_Layout::startMvc();

#        /** Rend_Controller_Action_Helper_LayoutSelector */
#        require_once 'Rend/Controller/Action/Helper/LayoutSelector.php';

#        Zend_Controller_Action_HelperBroker::addHelper(
#            new Rend_Controller_Action_Helper_LayoutSelector()
#        );

#        return $this;
#    }

#    /**
#     * Enable the SslSelector helper
#     *
#     * @return  Rend_Controller_Front
#     */
#    public function enableSslSelectorHelper()
#    {
#        if ($this->getParam('noSslSelector') || Zend_Controller_Action_HelperBroker::hasHelper('sslSelector')) {
#            return $this;
#        }

#        /** Rend_Controller_Action_Helper_SslSelector */
#        require_once 'Rend/Controller/Action/Helper/SslSelector.php';

#        Zend_Controller_Action_HelperBroker::addHelper(
#            new Rend_Controller_Action_Helper_SslSelector()
#        );

#        return $this;
#    }

    /**
     * Get the config
     *
     * @return  Zend_Config
     */
    public function getConfig()
    {
        if (!$this->getParam('config')) {
            $this->setParam(
                'config',
                new Zend_Config_Ini(
                    "{$this->getParam('path')}/application/config/config.ini",
                    $this->getParam('mode')
                )
            );
        }
        return $this->getParam('config');
    }

    /**
     * Get the factory plugin loader
     *
     * @return  Zend_Loader_PluginLoader
     */
    public function getFactoryPluginLoader()
    {
        if (!$this->getParam('factoryLoader')) {
            $this->setParam(
                'factoryLoader',
                new Zend_Loader_PluginLoader(array(
                    'Rend_Factory' => 'Rend/Factory'
                ))
            );
        }
        return $this->getParam('factoryLoader');
    }

    /**
     * Get the form plugin loader
     *
     * @return  Zend_Loader_PluginLoader
     */
    public function getFormPluginLoader()
    {
        if (!$this->getParam('formLoader')) {
            $this->setParam(
                'formLoader',
                new Zend_Loader_PluginLoader()
            );

            $filter = new Zend_Filter_Inflector(
                ':module_Form',
                array(
                    ':module' => array(
                        new Zend_Filter_Word_UnderscoreToCamelCase()
                    )
                )
            );

            foreach ($this->getControllerDirectory() as $name => $path) {
                $this->getParam('formLoader')
                     ->addPrefixPath($filter->filter(array('module' => $name)), "{$path}/../forms");
            }
        }
        return $this->getParam('formLoader');
    }

    /**
     * Get the model plugin loader
     *
     * @return  Zend_Loader_PluginLoader
     */
    public function getModelPluginLoader()
    {
        if (!$this->getParam('modelLoader')) {
            $this->setParam(
                'modelLoader',
                new Zend_Loader_PluginLoader()
            );

            foreach ($this->getControllerDirectory() as $controllerDirectory) {
                $this->getParam('modelLoader')
                     ->addPrefixPath('', "{$controllerDirectory}/../models");
            }
        }
        return $this->getParam('modelLoader');
    }

    /**
     * Set the mode
     *
     * @param   string  $mode
     * @return  Rend_Controller_Front
     */
    public function setMode($mode)
    {
        $this->setParam('mode', $mode);
        return $this;
    }

    /**
     * Set the path
     *
     * @param   string  $path
     * @return  Rend_Controller_Front
     */
    public function setPath($path)
    {
        $this->setParam('path', $path);
        return $this;
    }

}
