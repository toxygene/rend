<?php
if (isset($bootstrap) && $bootstrap) {
    error_reporting(E_ALL | E_STRICT);
    ini_set("error_log", "../data/logs/phperrors.log");
    ini_set("log_errors", true);

    set_include_path(realPath("../library"));

    /** Zend_Loader */
    require_once "Zend/Loader.php";
    Zend_Loader::registerAutoload();
}

/** Zend_Config_Ini */
require_once "Zend/Config/Ini.php";

$config = new Zend_Config_Ini(
    "../application/configs/config.ini",
    $_SERVER["REND_MODE"]
);

date_default_timezone_set($config->timezone);

/** Zend_Controller_Front */
require_once "Zend/Controller/Front.php";

$frontController = Zend_Controller_Front::getInstance();

if (isset($bootstrap)) {
    ini_set("display_errors", $config->displayErrors);
    ini_set('display_startup_errors', $config->displayErrors);
    $frontController->throwExceptions($config->displayErrors);
}

/** Rend_FactoryLoader */
require_once "Rend/FactoryLoader.php";

$factoryLoader = new Rend_FactoryLoader(
    $config->factoryLoader
);

$frontController->setParam("rendConfig", $config)
                ->setParam("rendFactoryLoader", $factoryLoader)
                ->addControllerDirectory("../application/controllers", "default")
                ->addModuleDirectory("../application/modules");

$frontController->getDispatcher()
                ->setParam("rendConfig", $config)
                ->setParam("rendFactoryLoader", $factoryLoader);

if (isset($config->routes)) {
    $frontController->getRouter()
                    ->addConfig($config->routes);
}

/** Zend_Controller_Action_HelperBroker */
require_once "Zend/Controller/Action/HelperBroker.php";

Zend_Controller_Action_HelperBroker::addPrefix(
    "Rend_Controller_Action_Helper"
);

/** Rend_Factory_View */
require_once "Rend/Factory/View.php";

$viewFactory = new Rend_Factory_View();

if (isset($config->view)) {
    $viewFactory->setConfig($config->view);
}

/** Zend_Controller_Action_Helper_ViewRenderer */
require_once "Zend/Controller/Action/Helper/ViewRenderer.php";

Zend_Controller_Action_HelperBroker::addHelper(
    new Zend_Controller_Action_Helper_ViewRenderer(
        $viewFactory->create()
    )
);

/** Zend_Layout */
require_once "Zend/Layout.php";

Zend_Layout::startMvc(array(
    "viewBasePath" => "../application/layouts"
));
