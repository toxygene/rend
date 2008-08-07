<?php
define('ROOT_PATH', dirname(dirname(__FILE__));
define('APP_PATH', ROOT_PATH . DIRECTORY_SEPARATOR . 'application');

// Setup error reporting
error_reporting(E_ALL | E_STRICT);
ini_set('display_errors', true);
ini_set('log_errors', true);
ini_set('error_log', ROOT_PATH . '/data/logs/phperrors.log');

// Setup include path
set_include_path(
    get_include_path() .
    PATH_SEPARATOR .
    ROOT_PATH . '/library'
);

/** Zend_Loader */
require_once 'Zend/Loader.php';
Zend_Loader::registerAutoload();

// Setup environment
ini_set('display_errors', $application->getConfig()->display_errors);
date_default_timezone_set($application->getConfig()->timezone);

Zend_Controller_Action_HelperBroker::addPrefix('Rend_Controller_Action_Helper');

Zend_Controller_Front::getInstance()
                     ->addControllerDirectory(APP_PATH . '/controllers', 'default')
                     ->addModuleDirectory(APP_PATH . '/modules')
                     ->setMode($_SERVER['REND_MODE'])
                     ->setPath(ROOT_PATH);
