<?php
if (isset($bootstrap) && $bootstrap) {
    error_reporting(E_ALL | E_STRICT);
    ini_set("error_log", "../data/logs/phperrors.log");
    ini_set("log_errors", true);

    set_include_path(
        get_include_path() .
        PATH_SEPARATOR .
        realpath(dirname(__FILE__) . '/../library')
    );

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

ini_set("display_errors", $config->displayErrors);

date_default_timezone_set($config->timezone);

/** Zend_Controller_Action_HelperBroker */
require_once "Zend/Controller/Action/HelperBroker.php";

Zend_Controller_Action_HelperBroker::addPrefix(
    "Rend_Controller_Action_Helper"
);

/** Rend_Factory_View */
require_once "Rend/Factory/View.php";

if (isset($config->view)) {
    $viewFactory = new Rend_Factory_View($config->view);
} else {
    $viewFactory = new Rend_Factory_View();
}

/** Zend_Controller_Action_Helper_ViewRenderer */
require_once "Zend/Controller/Action/Helper/ViewRenderer.php";

Zend_Controller_Action_HelperBroker::addHelper(
    new Zend_Controller_Action_Helper_ViewRenderer(
        $viewFactory->create()
    )
);

/** Zend_Controller_Front */
require_once "Zend/Controller/Front.php";

$front = Zend_Controller_Front::getInstance();

/** Rend_FactoryLoader */
require_once "Rend/FactoryLoader.php";

$factoryLoader = new Rend_FactoryLoader(
    $config
);

/** Zend_Layout */
require_once "Zend/Layout.php";

Zend_Layout::startMvc(array(
    "viewBasePath" => "../application/layouts"
));

$front->setParam("rendConfig", $config)
      ->setParam("rendFactoryLoader", $factoryLoader)
      ->throwExceptions($config->displayErrors);

$front->getDispatcher()
      ->setParam("rendConfig", $config)
      ->setParam("rendFactoryLoader", $factoryLoader);

$front->addControllerDirectory("../application/controllers", "default")
      ->addModuleDirectory("../application/modules");
