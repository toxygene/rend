<?php
/**
 * Custom error handler
 *
 * Converts errors to ErrorExceptions
 *
 * @param integer $errno
 * @param string $errstr
 * @param string $errfile
 * @param string $errline
 * @return boolean
 */
function rendErrorHandler($errno, $errstr, $errfile, $errline)
{
    if (error_reporting() & $errno) {
        throw new ErrorException($errstr, 0, $errno, $errfile, $errline);
        return true;
    }
}

if (isset($bootstrap) && $bootstrap) {
    set_error_handler("rendErrorHandler");

    error_reporting(E_ALL | E_STRICT);
    ini_set("error_log", "{$basePath}/data/logs/phperrors.log");
    ini_set("log_errors", true);

    $paths = array();
    $paths[] = realPath("{$basePath}/library");
    $paths[] = realPath("{$basePath}/application/models");
    foreach (glob("{$basePath}/application/modules/*/models") as $path) {
        $paths[] = realPath($path);
    }

    set_include_path(implode(
        PATH_SEPARATOR,
        $paths
    ));

    /** Zend_Loader */
    require_once "Zend/Loader.php";
    Zend_Loader::registerAutoload();
}

/** Zend_Config_Ini */
require_once "Zend/Config/Ini.php";

$config = new Zend_Config_Ini(
    "{$basePath}/application/configs/config.ini",
    $_SERVER["REND_MODE"]
);

/** Zend_Controller_Front */
require_once "Zend/Controller/Front.php";

$frontController = Zend_Controller_Front::getInstance();

if (isset($bootstrap)) {
    ini_set("display_errors", $config->displayErrors);
    ini_set("display_startup_errors", $config->displayErrors);
    $frontController->throwExceptions($config->displayErrors);
}

date_default_timezone_set($config->timezone);

/** Rend_FactoryLoader */
require_once "Rend/FactoryLoader.php";

$factoryLoader = new Rend_FactoryLoader(
    $config->factoryLoader
);

$frontController->setParam("rendConfig", $config)
                ->setParam("rendFactoryLoader", $factoryLoader)
                ->addControllerDirectory("{$basePath}/application/controllers", "default")
                ->addModuleDirectory("{$basePath}/application/modules");

if (isset($config->routes)) {
    $frontController->getRouter()
                    ->addConfig($config->routes);
}

/** Zend_Controller_Action_HelperBroker */
require_once "Zend/Controller/Action/HelperBroker.php";

Zend_Controller_Action_HelperBroker::addPrefix(
    "Rend_Controller_Action_Helper"
);

if (isset($factoryLoader->view) && $factoryLoader->view instanceof Rend_Factory_View_Interface) {
    $viewFactory = $factoryLoader->view;
} else {
    /** Rend_Factory_View */
    require_once "Rend/Factory/View.php";

    $viewFactory = new Rend_Factory_View();
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
    "viewBasePath" => "{$basePath}/application/layouts"
));
